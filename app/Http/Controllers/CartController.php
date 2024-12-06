<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(): View|RedirectResponse
    {
        return view('cart');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $productId = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];

        // Get the authenticated user and their cart
        $user = Auth::user();
        $cart = $user->cart ?? Cart::factory()->forUser($user)->create();

        try {
            $cart->addProduct($productId, $quantity);
            return redirect()->back()->with('success', 'Product added to cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $productId = $validatedData['product_id'];

        // Retrieve the user's cart
        $cart = Auth::user()->cart;
        if (!$cart || !$cart->hasProducts()) {
            return redirect('/')->with('error', 'Your cart is empty');
        }

        try {
            // Attempt to decrement the product quantity in the cart
            $message = $cart->decrementProductQuantity($productId);
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., product not in cart or other errors)
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
