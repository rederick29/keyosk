<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id)
    {
        $product = Product::query()->find($id);
        if (!$product) {
            return redirect()->route('index')->with('error', 'Product not found');
        }

        return view("product-view", ["product" => $product]);
    }
}
