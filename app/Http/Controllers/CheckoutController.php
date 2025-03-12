<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Models\Product;



class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $products = Product::all(); // Fetch all products

        return view('checkout', compact('products'));
    }
}