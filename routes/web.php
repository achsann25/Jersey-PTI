<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// ProductController akan kita buat di Tahap 3, jadi di-comment dulu biar ga error
use App\Http\Controllers\ProductController; 

// 1. Halaman Depan (Public)
Route::get('/', function () {
    return view('welcome'); // Bawaan Laravel
});

// 2. Rute Login/Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Rute Admin (Hanya bisa diakses kalau sudah login)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rute CRUD Jersey (Nanti dibuka di Tahap 3)
    Route::resource('products', ProductController::class);
});