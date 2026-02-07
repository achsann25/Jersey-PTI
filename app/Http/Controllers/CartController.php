<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // 1. Tambah ke Keranjang
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Validasi
        $request->validate([
            'size' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        // Cek apakah produk dengan size yang sama sudah ada di keranjang session ini
        $sessionId = Session::getId();
        $cartItem = Cart::where('session_id', $sessionId)
                        ->where('product_id', $id)
                        ->where('size', $request->size)
                        ->first();

        if($cartItem) {
            // Jika ada, tambahkan quantity-nya
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Jika belum, buat baru
            Cart::create([
                'session_id' => $sessionId,
                'product_id' => $id,
                'size'       => $request->size,
                'quantity'   => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Berhasil masuk keranjang!');
    }

    // 2. Lihat Daftar Keranjang
    public function index()
    {
        $sessionId = Session::getId();
        $carts = Cart::with('product')->where('session_id', $sessionId)->get();
        
        // Hitung Total Belanja
        $total = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', compact('carts', 'total'));
    }

    // 3. Hapus Item Keranjang
    public function destroy($id)
    {
        Cart::destroy($id);
        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}