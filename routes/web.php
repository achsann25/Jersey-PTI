<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

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
    // Cart
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout/{id}', [OrderController::class, 'show'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');

    // Riwayat Pesanan
    Route::get('/my-orders', [OrderController::class, 'history'])->name('order.history');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('customer.orders'); 
    Route::get('/order/repay/{id}', [OrderController::class, 'repay'])->name('order.repay');
    Route::patch('/orders/{id}/done', [OrderController::class, 'markAsDone'])->name('order.done');
});

/*
|--------------------------------------------------------------------------
| 5. ADMIN ROUTES (LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update');
    Route::patch('/orders/{id}/resi', [AdminOrderController::class, 'updateResi'])->name('orders.update_resi');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| 6. JURUS SAKTI: FIX DATABASE & AUTO-CREATE ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/fix-database', function () {
    try {
        // 1. Jalankan migrasi
        Artisan::call('migrate', ['--force' => true]);
        
        // 2. Tambahkan kolom user_id ke tabel orders jika belum ada
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                }
            });
        }

        // 3. BUAT AKUN ADMIN OTOMATIS
        $adminEmail = 'admin@gmail.com';
        $adminExists = User::where('email', $adminEmail)->orWhere('role', 'admin')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Administrator JerseyHolic',
                'username' => 'admin',
                'email' => $adminEmail,
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
        }
        
        // 4. Bersihkan Cache
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        
        return "MANTAP! Database sinkron & Akun Admin siap (User: admin, Pass: admin123). Coba login Admin sekarang!";
    } catch (\Exception $e) {
        return "Gagal update: " . $e->getMessage();
    }
});
