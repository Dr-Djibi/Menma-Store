<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.products.create', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
            'image_url2' => 'nullable|url',
            'image_url3' => 'nullable|url',
            'image_url4' => 'nullable|url',
            'image_url5' => 'nullable|url',
            'video_url' => 'nullable|url',
        ]);

        Product::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Produit ajouté !');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $settings = Setting::pluck('value', 'key');
        return view('admin.products.edit', compact('product', 'settings'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
            'image_url2' => 'nullable|url',
            'image_url3' => 'nullable|url',
            'image_url4' => 'nullable|url',
            'image_url5' => 'nullable|url',
            'video_url' => 'nullable|url',
        ]);

        $product->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Produit mis à jour !');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Produit supprimé !');
    }
}
