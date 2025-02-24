<?php

namespace App\Http\Controllers;

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
            // Address (will be used for both billing and shipping)
            'address.line_one' => ['required', 'string', 'max:255'],
            'address.line_two' => ['nullable', 'string', 'max:255'],
            'address.city' => ['required', 'string', 'max:100'],
            // 'address.country_id' => ['required', 'exists:countries,id'],, // TODO: hmm
            'address.postcode' => ['required', 'string', 'max:20'],
        ]);

        $user = Auth::user();
        $cart = $user->cart;
        if ($cart == null || !$cart->hasProducts()) {
            return response()->json(['error' => 'Cart is empty']);
        }

        // Line one/two, city, and postcode are required for an address
        // We will use these fields to search for an existing address or create a new one
        $searchCriteria = [
            'line_one' => $validatedData['address']['line_one'],
            'city' => $validatedData['address']['city'],
            'postcode' => $validatedData['address']['postcode']
        ];

        // Add line_two to criteria if it exists, otherwise explicitly set to null
        $searchCriteria['line_two'] = !empty($validatedData['address']['line_two'])
            ? $validatedData['address']['line_two']
            : null;

        // Create the address
        $priority = $user->addresses->isEmpty() ? 0 : $user->addresses->max('priority') + 1;
        $address = $user->addresses()->firstOrCreate(
            $searchCriteria,
            [
                'name' => $user->name,
                'country_id' => 1, // TODO: Replace with actual country ID
                'priority' => $priority
            ]
        );

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
        });

        // Some stuff here about taking the money out of the account, sending it to the warehouse, etc.
        // We will just simulate it by emptying the cart
        $cart->emptyList();

        return response()->json(['success' => 'Checkout successful']);
    }
}
