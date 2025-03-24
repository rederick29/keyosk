<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(): View
    {
        return view('wishlist');
    }

    public function add(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlist = Wishlist::firstOrCreate(['user_id' => Auth::id()]);

        // Check if product already in wishlist
        if (!$wishlist->products()->where('product_id', $validated['product_id'])->exists()) {
            // Attach product to wishlist
            $wishlist->products()->attach($validated['product_id']);

            return redirect()->back()->with('success', 'Item added to wishlist');
        }

        return redirect()->back()->with('info', 'Product already added to wishlist');
    }

    public function remove($productId): RedirectResponse
    {
        // Get the user's wishlist
        $wishlist = Wishlist::where('user_id', Auth::id())->firstOrFail();

        // Detach product from wishlist
        $wishlist->products()->detach($productId);

        return redirect()->back()->with('success', 'Item removed from wishlist');
    }

    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        // Get or create the user's wishlist
        $wishlist = Wishlist::firstOrCreate(['user_id' => Auth::id()]);

        // Check if product exists in wishlist
        if ($wishlist->products()->where('product_id', $validated['product_id'])->exists()) {
            // Remove product from wishlist
            $wishlist->products()->detach($validated['product_id']);
            return response()->json(['status' => 'removed']);
        } else {
            // Add product to wishlist
            $wishlist->products()->attach($validated['product_id']);
            return response()->json(['status' => 'added']);
        }
    }
}
