<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Image;

class OrdersController extends Controller
{
    public function index(){
        $orders = Order::all();
        $products = Product::all();
        $user = User::all();
        $images = Image::all();
        return view('/orders', compact('orders', 'products', 'user'));
    }
}
