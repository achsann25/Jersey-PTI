<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Menghitung jumlah produk
        $totalProducts = DB::table('products')->count();
        $stokTipis = DB::table('products')->where('stock', '<', 5)->count();

        // Tambahan: Hitung pendapatan dari pesanan yang sudah bayar/selesai
        $totalRevenue = Order::whereIn('status', ['paid', 'shipped', 'done'])->sum('total_price');
        $totalOrders = Order::count();

        return view('admin.dashboard', compact('totalProducts', 'stokTipis', 'totalRevenue', 'totalOrders'));
    }
}
