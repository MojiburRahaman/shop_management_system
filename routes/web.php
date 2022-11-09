<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    BrandController,
    CategoryController,
    DashboardController,
    ProductController,
};


Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('brand', BrandController::class);
});

require __DIR__ . '/auth.php';
