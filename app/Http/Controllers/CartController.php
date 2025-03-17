<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Models\Order\OrderStatus;
use Illuminate\Http\JsonResponse;
use App\Utils\CartUpdateAction;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): View|RedirectResponse
    {
        // No products, so why render the cart page?
        if (!$this->cartService->hasProducts()) {
            return redirect()->route('shop')->with('error', 'Cart is empty.');
        }

        return view('cart', [
            'products' => $this->cartService->getProducts(),
            'total' => $this->cartService->getTotalPrice()
        ]);
    }

    public function update(Request $request): RedirectResponse|JsonResponse
    {
        $validatedData = $request->validate([
            'cart_action' => ['required', Rule::enum(CartUpdateAction::class)],
            'product_id' => ['required', 'int', Rule::exists('products', 'id')],
            'quantity' => [
                'integer',
                'nullable',
                'min:1',
                // Quantity is required only for increase and decrease actions
                Rule::requiredIf(CartUpdateAction::needsQuantity($request->input('cart_action'))),
            ],
        ]);

        $productId = intval($validatedData['product_id']);
        $quantity = intval($validatedData['quantity'] ?? 1);

        try {
            $message = $this->cartService->processCartAction(
                CartUpdateAction::from($validatedData['cart_action']),
                $productId,
                $quantity
            );
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()]);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => $message,
                'total' => $this->cartService->getTotalPrice(),
                'products' => $this->cartService->getProducts()
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function checkout(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'save_address' => ['boolean', 'required'],
            'address_id' => ['nullable', 'int'],
            // Address (will be used for both billing and shipping)
            'address.name' => ['required_without:address_id', 'string', 'max:255'],
            'address.line_one' => ['required_without:address_id', 'string', 'max:255'],
            'address.line_two' => ['nullable', 'string', 'max:255'],
            'address.city' => ['required_without:address_id', 'string', 'max:100'],
            'address.postcode' => ['required_without:address_id', 'string', 'max:20'],
            'address.country' => ['required_without:address_id', 'string', Rule::exists('countries', 'code')],
            // contact details
            'contact.first_name' => ['nullable', 'string', 'max:255'],
            'contact.last_name' => ['nullable', 'string', 'max:255'],
            'contact.email' => ['nullable', 'email', 'string', 'max:255'],
            'card.name' => ['required', 'string', 'max:255'],
            'card.number' => ['required', 'int'],
            'card.expiry' => ['required', 'int'],
            'card.cvv' => ['required', 'int'],
            'discount_code' => ['nullable', 'string', 'max:255', Rule::exists('vouchers', 'code')],
        ]);

        $user = Auth::user();

        if (!$this->cartService->hasProducts()) {
            return response()->json(['error' => 'Cart is empty']);
        }

        // For authenticated users, we need to check stock
        if (Auth::check()) {
            $cart = $user->cart;
            if (
                $cart->products()->where(function ($q) {
                    $q->where('stock', 0)->orWhereColumn('products.stock', '<', 'cart_product.quantity');
                })->exists()
            ) {
                return response()->json(['error' => 'Not enough stock for a product in your cart.']);
            }
        }

        $address = null;
        if (isset($validatedData['address_id']) && $validatedData['address_id'] > -1) {
            $address = $user->addresses()->where('priority', $validatedData['address_id'])->first();
            if ($address == null) {
                return response()->json(['error' => 'Saved address not found.']);
            }
        } else {
            $country_id = Country::where('code', $validatedData['address']['country'])->first()->id;

            // We will use these fields to search for an existing address or create a new one
            $searchCriteria = [
                'name' => $validatedData['address']['name'],
                'line_one' => $validatedData['address']['line_one'],
                'city' => $validatedData['address']['city'],
                'postcode' => $validatedData['address']['postcode'],
                'country_id' => $country_id,
            ];

            // Add line_two to criteria if it exists, otherwise explicitly set to null
            $searchCriteria['line_two'] = !empty($validatedData['address']['line_two'])
                ? $validatedData['address']['line_two']
                : null;

            if (boolval($validatedData['save_address']) === true) {
                // Create the address
                $priority = Address::getMaxPriority($user);
                $address = $user->addresses()->firstOrCreate(
                    $searchCriteria,
                    [
                        'priority' => $priority + 1
                    ]
                );
            } else {
                $address = Address::factory()->create(array_merge($searchCriteria, [
                    'user_id' => $user ? $user->id : null,
                    'priority' => null,
                ]));
                $address->delete();
            }
        }

        $order = Order::create([
            'user_id' => $user ? $user->id : null,
            'address_id' => $address->id,
            'status' => OrderStatus::Pending,
            'total_price' => $this->cartService->getTotalPrice()
        ]);

        // Attach products to the order based on user type
        if (Auth::check()) {
            // For authenticated users, use the existing relationship method
            $user->cart->products->each(function ($product) use ($order) {
                $order->products()->attach($product->id, [
                    'price' => $product->price,
                    'quantity' => $product->pivot->quantity,
                ]);
                $product->stock -= $product->pivot->quantity;
                $product->save();
            });
        } else {
            // For guests, we need to manually loop through session cart products
            foreach ($this->cartService->getProducts() as $product) {
                $order->products()->attach($product['id'], [
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);

                // Update stock
                $productModel = \App\Models\Product::find($product['id']);
                $productModel->stock -= $product['quantity'];
                $productModel->save();
            }
        }

        // Empty the cart after successful checkout
        $this->cartService->emptyCart();

        return response()->json(['success' => 'Checkout successful', 'order_id' => $order->id]);
    }
}
