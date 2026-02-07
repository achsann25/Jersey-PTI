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
| 2. RAJAONGKIR (Opsional jika pakai API)
|--------------------------------------------------------------------------
*/
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);
Route::get('/cities/{province}', [RajaOngkirController::class, 'getCitiesByProvince']);
Route::post('/check-ongkir', [RajaOngkirController::class, 'checkCost']);

/*
|--------------------------------------------------------------------------
| 3. AUTH (LOGIN & REGISTER)
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
| 4. MIDTRANS CALLBACK
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

    // Checkout & Payment
    Route::get('/checkout/{id}', [OrderController::class, 'show'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');

    // Orders History
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
| 7. FIX DATABASE, ADMIN, & SHIPPING RATES (JURUS SAKTI)
|--------------------------------------------------------------------------
*/
Route::get('/fix-database', function () {
    try {
        // 1. Jalankan Migrasi
        Artisan::call('migrate', ['--force' => true]);

        // 2. Cek Kolom user_id di Tabel orders
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                }
            });
        }

        // 3. Suntik Data Kota & Ongkir (Banyak Kota)
        if (Schema::hasTable('shipping_rates')) {
            // Kosongkan dulu biar gak duplikat saat refresh
            DB::table('shipping_rates')->truncate(); 
            
            DB::table('shipping_rates')->insert([
                ['city_name' => 'Bandung', 'cost' => 10000],
                ['city_name' => 'Jakarta', 'cost' => 15000],
                ['city_name' => 'Surabaya', 'cost' => 20000],
                ['city_name' => 'Medan', 'cost' => 35000],
                ['city_name' => 'Makassar', 'cost' => 40000],
                ['city_name' => 'Yogyakarta', 'cost' => 18000],
                ['city_name' => 'Semarang', 'cost' => 17000],
                ['city_name' => 'Palembang', 'cost' => 30000],
                ['city_name' => 'Denpasar', 'cost' => 25000],
                ['city_name' => 'Balikpapan', 'cost' => 38000],
                ['city_name' => 'Malang', 'cost' => 19000],
                ['city_name' => 'Manado', 'cost' => 42000],
                ['city_name' => 'Banjarmasin', 'cost' => 36000],
                ['city_name' => 'Pekanbaru', 'cost' => 32000],
                ['city_name' => 'Bogor', 'cost' => 12000],
            ]);
        }

        // 4. Reset/Update Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return 'MANTAPP! Kereta sudah sampai di stasiun. Database sinkron, Admin siap, dan 15 Kota Ongkir sudah masuk!';
    } catch (\Exception $e) {
        return "Aduh, ada masalah: " . $e->getMessage();
    }
});

/*
|--------------------------------------------------------------------------
| 8. PENYELAMAT DEMO: FORCE LOGIN ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/force-login-admin', function () {
    $admin = User::where('role', 'admin')->first();
    if ($admin) {
        Auth::login($admin);
        return redirect()->route('admin.dashboard');
    }
    return 'Admin belum dibuat. Silakan akses /fix-database dulu!';
});
