<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman Dashboard Laporan Penjualan.
     */
    public function index()
    {
        // 1. Hitung Total Omzet (Pendapatan)
        // Hanya menghitung pesanan dengan status 'done' (selesai)
        $totalRevenue = Order::where('status', 'done')->sum('total_price');

        // 2. Hitung Total Item Terjual
        // Menjumlahkan kolom quantity dari pesanan yang selesai
        $itemsSold = Order::where('status', 'done')->sum('quantity');

        // 3. Hitung Total Transaksi Sukses
        // Menghitung jumlah baris data pesanan yang selesai
        $totalTransactions = Order::where('status', 'done')->count();

        // 4. Ambil Data Riwayat Penjualan Terakhir
        // Mengambil 10 transaksi terbaru yang sudah selesai beserta data produknya
        $recentSales = Order::with('product')
                            ->where('status', 'done')
                            ->latest()
                            ->take(10)
                            ->get();

        // Mengirimkan semua data yang dihitung ke view
        return view('admin.reports.index', compact(
            'totalRevenue', 
            'itemsSold', 
            'totalTransactions', 
            'recentSales'
        ));
    }
}