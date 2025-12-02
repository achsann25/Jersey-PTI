<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. Tampilkan Form Checkout
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('checkout', compact('product'));
    }

    // 2. Proses Simpan Pesanan
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|min:1',
            'customer_name' => 'required',
            'customer_whatsapp' => 'required',
            'address' => 'required',
            'payment_proof' => 'required|image|max:2048' // Wajib upload bukti
        ]);

        $product = Product::findOrFail($request->product_id);
        $total = $product->price * $request->quantity;

        // Upload Bukti Bayar
        $imagePath = $request->file('payment_proof')->store('payments', 'public');

        // Simpan Order
        Order::create([
            'product_id' => $request->product_id,
            'customer_name' => $request->customer_name,
            'customer_whatsapp' => $request->customer_whatsapp,
            'address' => $request->address,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'pending',
            'payment_proof' => $imagePath
        ]);

        // Kurangi Stok Produk (Opsional, biar keren)
        $product->decrement('stock', $request->quantity);

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat! Tunggu konfirmasi Admin via WhatsApp.');
    }
}