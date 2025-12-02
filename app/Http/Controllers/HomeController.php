<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan Landing Page (Halaman Utama).
     */
    public function index()
    {
        // Ambil semua data produk, urutkan dari yang terbaru
        $products = Product::latest()->get();
        
        // Kirim data ke view 'landing'
        return view('landing', compact('products'));
    }

    /**
     * Menampilkan Halaman About Us.
     */
    public function about()
    {
        return view('about_us');
    }
}