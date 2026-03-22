<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(6);
        $settings = Setting::pluck('value', 'key');
        
        return view('index', compact('products', 'settings'));
    }

    public function show($id)
    {
        $product = Product::with('comments')->findOrFail($id);
        $settings = Setting::pluck('value', 'key');
        
        return view('show', compact('product', 'settings'));
    }
}
