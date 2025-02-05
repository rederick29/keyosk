<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(int $id)
    {
        try {
            $product = Product::findOrFail($id);
            return view("product-view", compact('product'));
        } catch (ModelNotFoundException $e) {
            return redirect('/')->with('error', 'Product not found');
        }
    }

    public function carousel()
    {
        // Fetch the latest 10 products from the database
        $products = Product::latest()->take(10)->get();

        // Debugging: Check if products exist
        if ($products->isEmpty()) {
            \Log::error("❌ No products found for carousel.");
        } else {
            \Log::info("✅ Products loaded for carousel:", $products->toArray());
        }

        // Dump the data and stop execution to check if products exist
        dd($products);

        return view('components.carousel', ['products' => $products]);
    }

}
