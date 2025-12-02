<?php

namespace App\Http\Controllers;

use App\Models\Product; // Pastikan Model Product di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib di-import untuk fitur hapus gambar

class ProductController extends Controller
{
    /**
     * 1. READ: Menampilkan daftar semua jersey.
     */
    public function index()
    {
        // Mengambil data terbaru dari database
        $products = Product::latest()->get();
        
        // Mengirim data ke view 'index'
        return view('admin.products.index', compact('products'));
    }

    /**
     * 2. CREATE: Menampilkan form untuk menambah jersey baru.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * 3. STORE: Memproses penyimpanan data baru ke database.
     */
    public function store(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'team_name' => 'required|string|max:255',
            'season'    => 'required|string|max:50',
            'price'     => 'required|numeric|min:0',
            'stock'     => 'required|numeric|min:0',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Max 2MB
        ]);

        // B. Upload Gambar (Jika ada)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan di folder 'public/products'
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // C. Simpan ke Database
        Product::create([
            'team_name' => $request->team_name,
            'season'    => $request->season,
            'price'     => $request->price,
            'stock'     => $request->stock,
            'image'     => $imagePath
        ]);

        // D. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Jersey berhasil ditambahkan!');
    }

    /**
     * 4. EDIT: Menampilkan form untuk mengedit data jersey.
     */
    public function edit(Product $product)
    {
        // Laravel otomatis mencarikan data Product berdasarkan ID di URL
        return view('admin.products.edit', compact('product'));
    }

    /**
     * 5. UPDATE: Memproses perubahan data (termasuk ganti gambar).
     */
    public function update(Request $request, Product $product)
    {
        // A. Validasi Input
        $request->validate([
            'team_name' => 'required|string|max:255',
            'season'    => 'required|string|max:50',
            'price'     => 'required|numeric|min:0',
            'stock'     => 'required|numeric|min:0',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // B. Cek apakah user mengupload gambar baru
        if ($request->hasFile('image')) {

            // 1. Hapus gambar lama dari penyimpanan (jika ada)
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // 2. Upload gambar baru
            $imagePath = $request->file('image')->store('products', 'public');

            // 3. Update data di database (termasuk kolom image)
            $product->update([
                'team_name' => $request->team_name,
                'season'    => $request->season,
                'price'     => $request->price,
                'stock'     => $request->stock,
                'image'     => $imagePath
            ]);

        } else {
            // C. Jika tidak ada gambar baru, update data teks saja
            // Gambar lama tetap dipertahankan
            $product->update([
                'team_name' => $request->team_name,
                'season'    => $request->season,
                'price'     => $request->price,
                'stock'     => $request->stock,
            ]);
        }

        // D. Redirect dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Data jersey berhasil diperbarui!');
    }

    /**
     * 6. DESTROY: Menghapus data jersey dari database.
     */
    public function destroy(Product $product)
    {
        // A. Hapus file gambar dari folder penyimpanan (jika ada)
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // B. Hapus record dari database
        $product->delete();

        // C. Redirect dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Jersey berhasil dihapus!');
    }
}