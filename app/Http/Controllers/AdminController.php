<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Menghitung jumlah data langsung dari database
        // Kita pakai DB::table dulu biar tidak error kalau Model belum dibuat
        $totalProducts = DB::table('products')->count();
        $stokTipis = DB::table('products')->where('stock', '<', 5)->count();

        return view('admin.dashboard', compact('totalProducts', 'stokTipis'));
    }
}