<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Omzet (Hanya yang sudah bayar ke atas)
        $totalRevenue = Order::whereIn('status', ['paid', 'shipped', 'done'])->sum('total_price');

        // 2. Hitung Total Item Terjual
        $itemsSold = Order::whereIn('status', ['paid', 'shipped', 'done'])->sum('quantity');

        // 3. Hitung Total Transaksi Sukses (Sudah Bayar)
        $totalTransactions = Order::whereIn('status', ['paid', 'shipped', 'done'])->count();

        // 4. Ambil Semua Data Riwayat Penjualan untuk Tabel
        $recentSales = Order::with('product')
                            ->latest()
                            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue', 
            'itemsSold', 
            'totalTransactions', 
            'recentSales'
        ));
    }
}
