<?php

namespace App\Http\Controllers;

use App\Models\Product; // Penting: Import Model Product agar bisa dipakai
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar jersey (READ).
     */
    public function index()
    {
        // 1. Ambil data dari database, urutkan dari yang terbaru
        $products = Product::latest()->get();
        
        // 2. Kirim data ($products) ke view 'admin.products.index'
        return view('admin.products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah data (CREATE).
     * (Akan kita gunakan di langkah selanjutnya)
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Menyimpan data baru (STORE).
     * (Akan diisi nanti)
     */
    public function store(Request $request)
    {
        // Kosong dulu
    }

    /**
     * Menampilkan form edit (EDIT).
     */
    public function edit(Product $product)
    {
        // Kosong dulu
    }

    /**
     * Update data (UPDATE).
     */
    public function update(Request $request, Product $product)
    {
        // Kosong dulu
    }

    /**
     * Hapus data (DESTROY).
     */
    public function destroy(Product $product)
    {
        // Kosong dulu
    }
}