<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('product')->orderBy('id', 'desc')->get();
        $settings = Setting::pluck('value', 'key');
        return view('admin.comments.index', compact('comments', 'settings'));
    }

    public function create()
    {
        $products = Product::orderBy('nom', 'asc')->get();
        $settings = Setting::pluck('value', 'key');
        return view('admin.comments.create', compact('products', 'settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'nom_client' => 'required|string|max:255',
            'note' => 'required|integer|min:1|max:5',
            'texte' => 'required|string',
        ]);

        Comment::create($data);

        return redirect()->route('admin.comments.index')->with('success', 'Avis ajouté !');
    }
}
