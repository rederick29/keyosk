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
            'product_id' => ['required', Rule::exists('products', 'id')],
            'quantity' => ['integer', 'min:1', Rule::requiredIf(CartUpdateAction::needsQuantity($request['action']))],
        ]);
        $message = "";

        $user = Auth::user();
        $productId = intval($validatedData['product_id']);
        $quantity = intval($validatedData['quantity']) ?? 1;
        $cart = $user->cart ?? Cart::factory()->forUser($user)->create();

        try {
            switch ($validatedData['action']) {
                case CartUpdateAction::Add->value:
                case CartUpdateAction::Increase->value:
                    $cart->addProduct($productId, $quantity);
                    $message = 'Product added to cart';
                    break;
                case CartUpdateAction::Remove->value:
                case CartUpdateAction::Decrease->value:
                    $message = $cart->removeProduct($productId, $quantity);
                    break;
            };
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', $message);
    }
}
