<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->orderBy('id', 'desc')->get();
        $settings = Setting::pluck('value', 'key');
        return view('admin.orders.index', compact('orders', 'settings'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->only('statut_livraison', 'visible'));

        return back()->with('success', 'Commande mise à jour !');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Commande supprimée !');
    }
}
