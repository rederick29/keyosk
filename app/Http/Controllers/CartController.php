<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(): View | RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login.get')->with('error', 'Please login first');
        }

        return view('cart');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if (!Auth::check()) {
            return redirect()->route('login.get')->with('error', 'Please login first');
        }

        $cart = Auth::user()->cart;
        if (!$cart) {
            $cart = Cart::factory()->forUser(Auth::user())->create();
        }

        if ($cart->products()->where('products.id', $validatedData['product_id'])->first()) {
            $quantity = $cart->getProductQuantity($validatedData['product_id']);
            if ($quantity + $validatedData['quantity'] > Product::query()->where('id', $validatedData['product_id'])->first()->stock) {
                return redirect()->back()->with('error', 'Quantity exceeds product stock');
            }
            $cart->products()->updateExistingPivot($validatedData['product_id'], ['quantity' => $validatedData['quantity'] + $quantity]);
        } else {
            $cart->products()->attach($validatedData['product_id'], ['quantity' => $validatedData['quantity']]);
        }
        // TODO: needs a cart view
        // return redirect()->route('cart.index')->with('success', 'Product added to cart');
        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        if (!Auth::check()) {
            return redirect()->route('login.get')->with('error', 'Please login first');
        }

        $cart = Auth::user()->cart();
        if (!$cart) {
            return redirect('/')->with('error', 'Your cart is empty');
        }

        if ($cart->products()->where('products.id', $validatedData['product_id'])->first()) {
            $quantity = $cart->getProductQuantity($validatedData['product_id']);
            if ($quantity == 1) {
                $cart->products()->detach($validatedData['product_id']);
                return redirect()->back()->with('success', 'Product removed from cart');
            } else {
                $cart->products()->updateExistingPivot($validatedData['product_id'], ['quantity' => $quantity - 1]);
                return redirect()->back();
            }
        }
        return redirect()->back()->with('error', 'This product is not in your cart');
    }
}
