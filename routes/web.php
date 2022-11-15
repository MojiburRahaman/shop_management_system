<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    BrandController,
    CategoryController,
    DashboardController,
    ProductController,
    SupplierController,
};


Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('supplier', SupplierController::class)->except('create');
    Route::resource('product', ProductController::class)->except('create','show');
    Route::resource('category', CategoryController::class)->except('create','show');
    Route::resource('brand', BrandController::class)->except('create','show');
});

require __DIR__ . '/auth.php';
