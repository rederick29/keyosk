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
use App\Models\Cart;
use function PHPUnit\Framework\assertEquals;

class CartController extends Controller
{
    public function index(): View|RedirectResponse
    {
        // No products, so why render the cart page?
        if (!Auth::user()->cart->hasProducts()) {
            return redirect()->route('shop')->with('error', 'Cart is empty.');
        }

        return view('cart');
    }

    public function update(Request $request): RedirectResponse | JsonResponse
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

        $user = Auth::user();
        $productId = intval($validatedData['product_id']);
        $quantity = intval($validatedData['quantity'] ?? 1);
        $cart = $user->cart ?? Cart::factory()->forUser($user)->create();

        try {
            $message = $this->processCartAction($cart, CartUpdateAction::from($validatedData['cart_action']), $productId, $quantity);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()]);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json(['success' => $message]);
        }
        return redirect()->back()->with('success', $message);
    }

    /**
     * Process the cart action based on the provided action and product details.
     *
     * @param Cart $cart
     * @param CartUpdateAction $action
     * @param int $productId
     * @param int $quantity
     * @return string
     */
    private function processCartAction(Cart $cart, CartUpdateAction $action, int $productId, int $quantity): string
    {
        switch ($action) {
            case CartUpdateAction::Add:
            case CartUpdateAction::Increase:
                $cart->addProduct($productId, $quantity);
                return 'Product added to cart';

            case CartUpdateAction::Remove:
                $cart->emptyItem($productId);
                return 'Product removed from cart';

            case CartUpdateAction::Decrease:
                $cart->removeProduct($productId, $quantity);
                return 'Product quantity decreased';

            default:
                throw new \InvalidArgumentException('Invalid cart action');
        }
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
        $cart = $user->cart;
        if ($cart == null || !$cart->hasProducts()) {
            return response()->json(['error' => 'Cart is empty']);
        }

        if ($cart->products()->where(function ($q) {
            $q->where('stock', 0)->orWhereColumn('products.stock', '<', 'cart_product.quantity');
        })->exists()) {
            return response()->json(['error' => 'Not enough stock for a product in your cart.']);
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
                    'user_id' => $user->id,
                    'priority' => null,
                ]));
                $address->delete();
            }
        }

        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $address->id,
            'status' => OrderStatus::Pending,
            'total_price' => $cart->getTotalPrice()
        ]);

        // Attach products to the order
        $cart->products->each(function ($product) use ($order) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
            ]);
            $product->stock -= $product->pivot->quantity;
            $product->save();
        });

        // Some stuff here about taking the money out of the account, sending it to the warehouse, etc.
        // We will just simulate it by emptying the cart
        $cart->emptyList();

        return response()->json(['success' => 'Checkout successful']);
    }
}
