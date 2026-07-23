<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/products/{product:slug}', [\App\Http\Controllers\Front\ProductController::class, 'show'])->name('products.show');
Route::resource('/cart', App\Http\Controllers\Front\CartController::class);
Route::get('/checkout', [App\Http\Controllers\Front\CheckOutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [App\Http\Controllers\Front\CheckOutController::class, 'store'])->name('checkout.store');

require
    __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';