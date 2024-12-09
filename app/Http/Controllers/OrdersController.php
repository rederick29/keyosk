<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        // Get all orders for the authenticated user with their products and images order by latest first
        $orders = Order::with(['user', 'products.images'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('orders', compact('orders'));
    }
}
