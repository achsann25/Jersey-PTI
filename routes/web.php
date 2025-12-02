<?php

use Illuminate\Support\Facades\Route;
// Import semua Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ReportController; // <--- PENTING: Tambahan Baru

/*
|--------------------------------------------------------------------------
| 1. Rute Public (Akses Bebas)
|--------------------------------------------------------------------------
*/

// Halaman Depan
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Fitur Checkout
Route::get('/checkout/{id}', [OrderController::class, 'show'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');


/*
|--------------------------------------------------------------------------
| 2. Rute Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 3. Rute Admin (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // CRUD Produk
    Route::resource('products', ProductController::class);

    // Manajemen Order
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update');

    // Laporan Penjualan (RUTE BARU)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

});