<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;



class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = app(CartService::class);
        if ($cart->hasProducts()) {
            return view('checkout');
        }
        return to_route('index')->with('error', 'Nothing to checkout.');
    }
}
