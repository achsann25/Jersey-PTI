<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan Landing Page dengan Fitur Pencarian.
     */
    public function index(Request $request)
    {
        // Mulai query produk
        $query = Product::latest();

        // Cek apakah ada pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // Filter berdasarkan nama tim ATAU musim
            $query->where(function($q) use ($search) {
                $q->where('team_name', 'like', "%{$search}%")
                  ->orWhere('season', 'like', "%{$search}%");
            });
        }

        // Ambil hasil data
        $products = $query->get();
        
        // Kirim data ke view 'landing'
        return view('landing', compact('products'));
    }

    /**
     * Menampilkan Halaman Detail Produk.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product_detail', compact('product'));
    }

    /**
     * Menampilkan Halaman About Us.
     */
    public function about()
    {
        return view('about_us');
    }
}