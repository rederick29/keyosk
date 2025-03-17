<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(int $id)
    {
        try {
            $product = Product::findOrFail($id);
            return view("product-view", compact('product'));
        } catch (ModelNotFoundException) {
            return redirect('/')->with('error', 'Product not found');
        }
    }

    public function manage_products(): View
    {
        return view('manage-products');
    }

    public function index_edit(int $productId)
    {
        $product = null;
        try {
            $product = Product::findOrFail($productId);
        } catch (ModelNotFoundException) {
            return to_route('manage-products')->with('error', 'Product not found');
        }
        return view("edit-product", compact('product'));
    }

    public function update(int $productId, Request $request): RedirectResponse
    {
        $product = null;
        try {
            $product = Product::findOrFail($productId);
        } catch (ModelNotFoundException) {
            // when using the website normally, this is nonsensical. we're on the page of a product that doesn't exist?
            return to_route('product.get.edit', compact('productId'))->with('error', 'Product not found');
        }

        $validated = $request->validate([
            'product_name' => 'string',
            'product_short_desc' => 'string',
            'product_desc' => 'string',
            'product_stock' => 'integer',
            'product_price' => 'decimal:2,4',
        ]);

        $name_map = [
            'name' => 'product_name',
            'short_description' => 'product_short_desc',
            'description' => 'product_desc',
            'stock' => 'product_stock',
            'price' => 'product_price',
        ];

        $updates = [];

        foreach ($name_map as $field => $form_input) {
            if ($product->$field != $validated[$form_input]) {
                $updates[$field] = $validated[$form_input];
            }
        }

        if (!empty($updates)) {
            $product->update($updates);
        }

        return to_route('manage-products')->with('success', 'Product updated successfully.');
    }

    public function review_index(int $id)
    {
        $product = null;
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException) {
            return to_route('index')->with('error', 'Product not found');
        }
        return view("review", compact('product'));
    }

    public function review_store(int $id, Request $request): RedirectResponse
    {
        $product = null;
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException) {
            return to_route('index')->with('error', 'Product not found');
        }

        Review::create([
            'comment' => $request->input('comment'),
            'subject' => $request->input('subject'),
            'rating' => $request->input('rating'),
            'user_id' => auth()->id(),
            'product_id' => $id,
        ]);

        return redirect()->route('orders.get')->with('success', 'Review submitted successfully.');
    }
}
