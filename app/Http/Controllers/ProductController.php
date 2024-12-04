<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = DB::table("products")->where('id', 1)->get();

        return view("product-view", ["products"=> $products]);
    }
}
