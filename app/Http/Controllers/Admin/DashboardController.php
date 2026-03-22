<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::where('visible', true)->count();
        $totalComments = Comment::count();
        $revenue = Order::where('visible', true)
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->sum('products.prix');

        $products = Product::orderBy('id', 'desc')->get();
        $settings = Setting::pluck('value', 'key');

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalComments', 'revenue', 'products', 'settings'));
    }
}
