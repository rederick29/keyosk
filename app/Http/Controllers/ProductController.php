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
}
