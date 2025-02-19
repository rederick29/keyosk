<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class OrdersController extends Controller
{
    public function index($userId = null)
    {
        if ($userId === null || !Auth::user()->is_admin) {
            $userId = Auth::id();
        }

        // Get all orders for the authenticated user with their products and images order by latest first
        $orders = Order::with(['user', 'products.images'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('orders', compact('orders', 'userId'));
    }

    public function manage_orders(): View
    {
        return view('manage-orders');
    }
}
