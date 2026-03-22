<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'nom_client' => 'required|string|max:255',
            'adresse_livraison' => 'required|string',
        ]);

        $order = Order::create($request->all());
        
        $product = Product::find($request->product_id);
        if ($product && $product->stock > 0) {
            $product->decrement('stock');
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order]);
    }
}
