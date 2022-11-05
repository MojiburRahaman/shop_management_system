<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\{
    DashboardController,
    ProductController,
};


Route::get('/', function () {
    return redirect()->route('login');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('product', ProductController::class);
});

require __DIR__ . '/auth.php';
