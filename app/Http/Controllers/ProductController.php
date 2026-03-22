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

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $settings = Setting::pluck('value', 'key');
        $whatsappNumber = $settings['whatsapp_number'] ?? '224625968097';
        
        $text = "Bonjour Menma Shop ! 💬\n\n";
        $text .= "*Nom* : " . $request->name . "\n";
        $text .= "*Tél* : " . $request->phone . "\n";
        $text .= "*Message* : " . $request->message;

        $url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsappNumber) . "?text=" . urlencode($text);

        return redirect($url);
    }
}
