<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, 
    AdminController, 
    ProductController, 
    HomeController, 
    OrderController, 
    AdminOrderController, 
    ReportController, 
    CartController, 
    CustomerController, 
    RajaOngkirController
};

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIC (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// Home & Produk
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// RajaOngkir API
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);
Route::get('/cities/{province}', [RajaOngkirController::class, 'getCitiesByProvince']);
Route::post('/check-ongkir', [RajaOngkirController::class, 'checkCost']);


/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION (LOGIN, REGISTER, LOGOUT)
|--------------------------------------------------------------------------
*/

// Login Customer
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Login Admin
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

// Register & Logout
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 3. MIDTRANS WEBHOOK (WAJIB DI LUAR AUTH)
|--------------------------------------------------------------------------
*/
Route::post('/midtrans-callback', [OrderController::class, 'callback']);


/*
|--------------------------------------------------------------------------
| 4. CUSTOMER ROUTES (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Cart (Keranjang)
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout/{id}', [OrderController::class, 'show'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');

    // Riwayat Pesanan & Repay
    Route::get('/my-orders', [OrderController::class, 'history'])->name('order.history');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('customer.orders'); 
    Route::get('/order/repay/{id}', [OrderController::class, 'repay'])->name('order.repay');
    
    // --- TAMBAHAN: Selesaikan Pesanan ---
    Route::patch('/orders/{id}/done', [OrderController::class, 'markAsDone'])->name('order.done');
});


/*
|--------------------------------------------------------------------------
| 5. ADMIN ROUTES (LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Produk CRUD
    Route::resource('products', ProductController::class);

    // Manajemen Order oleh Admin
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update');
    
    // --- TAMBAHAN FITUR TRACKING RESI ---
    // Rute untuk handle form input resi dan trigger kirim email
    Route::patch('/orders/{id}/resi', [AdminOrderController::class, 'updateResi'])->name('orders.update_resi');

    // Laporan Penjualan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

});