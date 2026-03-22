<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->except(['index', 'show']);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'update', 'destroy']);
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::resource('comments', App\Http\Controllers\Admin\CommentController::class)->only(['index', 'create', 'store']);
});

// Auth Routes (Fake for now or implement simply)
Route::post('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');
