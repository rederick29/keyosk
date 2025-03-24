<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'tags' => ['required', 'array'],
            'tags.*.id' => ['required', 'integer', Rule::exists('tags', 'id')],
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

        foreach (request()->get('tags') as $tag) {
            if (isset($tag['value']) && $tag['value'] === 'on') {
                $product->tags()->attach($tag['id']);
            } else if ($product->tags->contains('id', $tag['id'])) {
                $product->tags()->detach($tag['id']);
            }
        }

        return to_route('manage-products')->with('success', 'Product updated successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'product_name' => ['required', 'string'],
            'product_short_desc' => ['required', 'string'],
            'product_desc' => ['nullable', 'string'],
            'product_stock' => ['required', 'integer'],
            'product_price' => ['required', 'decimal:2,4'],
            'product_image' => ['required', Rule::imageFile()->max(4096)->types('image/*')],
            'tags' => ['required', 'array'],
            'tags.*.id' => ['required', 'integer', Rule::exists('tags', 'id')],
        ]);

        $priority = 0;
        $product = Product::factory()->create([
            'name' => $validatedData['product_name'],
            'short_description' => $validatedData['product_short_desc'],
            'description' => $validatedData['product_desc'],
            'stock' => $validatedData['product_stock'],
            'price' => $validatedData['product_price'],
        ]);

        foreach (request()->get('tags') as $tag) {
            if (isset($tag['value']) && $tag['value'] === 'on') {
                $product->tags()->attach($tag['id']);
            }
        }

        try {
            ImageUploaderController::store_image_product($product, $request->file('product_image'), $priority);
        } catch (\Exception $e) {
            return back()->with('error', 'Database error: ' . $e->getMessage());
        }

        return to_route('manage-products')->with('success', 'Product added successfully.');
    }

    public function destroy(int $productId): RedirectResponse
    {
        $product = Product::find($productId);
        if (!$product) {
            return back()->with('error', 'Product not found');
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }

    public function index_add(): View
    {
        return view('add-product');
    }
}
