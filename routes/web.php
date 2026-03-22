<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
