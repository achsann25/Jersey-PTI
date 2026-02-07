<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

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
| 1. PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

/*
|--------------------------------------------------------------------------
| 2. RAJAONGKIR
|--------------------------------------------------------------------------
*/
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);
Route::get('/cities/{province}', [RajaOngkirController::class, 'getCitiesByProvince']);
Route::post('/check-ongkir', [RajaOngkirController::class, 'checkCost']);

/*
|--------------------------------------------------------------------------
| 3. AUTH (CUSTOMER & ADMIN)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 4. MIDTRANS CALLBACK (NO AUTH)
|--------------------------------------------------------------------------
*/
Route::post('/midtrans-callback', [OrderController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| 5. CUSTOMER ROUTES (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout/{id}', [OrderController::class, 'show'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');

    // Orders
    Route::get('/my-orders', [OrderController::class, 'history'])->name('order.history');
    Route::get('/order/repay/{id}', [OrderController::class, 'repay'])->name('order.repay');
    Route::patch('/orders/{id}/done', [OrderController::class, 'markAsDone'])->name('order.done');
});

/*
|--------------------------------------------------------------------------
| 6. ADMIN ROUTES (AUTH + ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/products', ProductController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update');
    Route::patch('/orders/{id}/resi', [AdminOrderController::class, 'updateResi'])->name('orders.update_resi');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| 7. FIX DATABASE + AUTO CREATE ADMIN (DEV ONLY)
|--------------------------------------------------------------------------
*/
Route::get('/fix-database', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);

        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                }
            });
        }

        $adminEmail = 'admin@gmail.com';
        if (!User::where('role', 'admin')->exists()) {
            User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => $adminEmail,
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
        }

        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');

        return 'OK - Database & Admin siap (User: admin, Pass: admin123)';
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

/*
|--------------------------------------------------------------------------
| 8. PENYELAMAT DEMO: FORCE LOGIN ADMIN
|--------------------------------------------------------------------------
| Jika login admin macet saat demo, akses link: /force-login-admin
*/
Route::get('/force-login-admin', function () {
    $admin = User::where('role', 'admin')->first();
    if ($admin) {
        Auth::login($admin);
        return redirect()->route('admin.dashboard');
    }
    return 'Admin tidak ditemukan. Jalankan /fix-database dulu.';
});
