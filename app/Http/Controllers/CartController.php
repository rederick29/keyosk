<?php

namespace App\Http\Controllers;

use App\Utils\CartUpdateAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function index(): View|RedirectResponse
    {
        return view('cart');
    }

    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'action' => ['required', Rule::enum(CartUpdateAction::class)],
            'product_id' => ['required', 'int', Rule::exists('products', 'id')],
            'quantity' => [
                'integer',
                'min:1',
                // Quantity is required only for increase and decrease actions
                Rule::requiredIf(CartUpdateAction::needsQuantity($request->input('action'))),
            ],
        ]);

        $user = Auth::user();
        $productId = intval($validatedData['product_id']);
        $quantity = intval($validatedData['quantity'] ?? 1);
        $cart = $user->cart ?? Cart::factory()->forUser($user)->create();

        try {
            $message = $this->processCartAction($cart, CartUpdateAction::from($validatedData['action']), $productId, $quantity);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
}
