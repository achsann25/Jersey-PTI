<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

// 1. PUBLIC ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');

// 2. AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. MIDTRANS CALLBACK
Route::post('/midtrans-callback', [OrderController::class, 'callback']);

// 4. CUSTOMER (AUTH)
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout/{id}', [OrderController::class, 'show'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
    Route::get('/my-orders', [OrderController::class, 'history'])->name('order.history');
    Route::get('/order/repay/{id}', [OrderController::class, 'repay'])->name('order.repay');
    Route::patch('/orders/{id}/done', [OrderController::class, 'markAsDone'])->name('order.done');
});

// 5. ADMIN (AUTH + ADMIN)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/products', ProductController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update');
    Route::patch('/orders/{id}/resi', [AdminOrderController::class, 'updateResi'])->name('orders.update_resi');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

// 6. JURUS SAKTI: FIX DATABASE & SHIPPING
Route::get('/fix-database', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);

        // MENGOSONGKAN DATA PESANAN (RESET TRANSAKSI)
        if (Schema::hasTable('orders')) {
            DB::table('orders')->truncate(); 
        }

        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                }
            });
        }

        // INSERT DATA KOTA (Sangat Banyak)
        if (Schema::hasTable('shipping_rates')) {
            DB::table('shipping_rates')->truncate(); 
            DB::table('shipping_rates')->insert([
                ['city_name' => 'Bandung', 'cost' => 10000, 'courier' => 'JNE'],
                ['city_name' => 'Jakarta', 'cost' => 15000, 'courier' => 'JNE'],
                ['city_name' => 'Surabaya', 'cost' => 20000, 'courier' => 'TIKI'],
                ['city_name' => 'Medan', 'cost' => 35000, 'courier' => 'J&T'],
                ['city_name' => 'Yogyakarta', 'cost' => 18000, 'courier' => 'SiCepat'],
                ['city_name' => 'Semarang', 'cost' => 17000, 'courier' => 'JNE'],
                ['city_name' => 'Palembang', 'cost' => 30000, 'courier' => 'TIKI'],
                ['city_name' => 'Denpasar', 'cost' => 25000, 'courier' => 'J&T'],
                ['city_name' => 'Bogor', 'cost' => 12000, 'courier' => 'SiCepat'],
                ['city_name' => 'Malang', 'cost' => 19000, 'courier' => 'JNE'],
                ['city_name' => 'Makassar', 'cost' => 40000, 'courier' => 'J&T'],
                ['city_name' => 'Balikpapan', 'cost' => 38000, 'courier' => 'TIKI'],
            ]);
        }

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'username' => 'admin', 'password' => Hash::make('admin123'), 'role' => 'admin']
        );

        return 'DATABASE RESET BERHASIL - Data Pesanan Kosong & Admin Siap';
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// 7. FORCE LOGIN
Route::get('/force-login-admin', function () {
    $admin = User::where('role', 'admin')->first();
    if ($admin) { Auth::login($admin); return redirect()->route('admin.dashboard'); }
    return 'Gagal force login.';
});
