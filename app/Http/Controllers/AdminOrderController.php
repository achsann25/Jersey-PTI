<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderShippedMail;
use Illuminate\Support\Facades\Mail;


class AdminOrderController extends Controller
{
    // Lihat semua order
    public function index()
    {
        $orders = Order::with('product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Update status (misal: dari pending -> shipped)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan diperbarui!');
    }


public function updateResi(Request $request, $id)
{
    $order = \App\Models\Order::with('product')->findOrFail($id);
    
    // Simpan status lama sebelum diupdate untuk pengecekan
    $previousStatus = $order->status;

    // 1. Update data resi dan status ke database
    $order->update([
        'tracking_number' => $request->tracking_number,
        'status' => 'shipped'
    ]);

    // 2. Logika Pengurangan Stok
    // Kita kurangi stok HANYA JIKA status sebelumnya bukan 'shipped' 
    // agar stok tidak berkurang berkali-kali jika admin update resi lagi.
    if ($previousStatus !== 'shipped') {
        $product = $order->product;
        if ($product->stock >= $order->quantity) {
            $product->decrement('stock', $order->quantity);
        } else {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk memproses pengiriman!');
        }
    }

    // 3. Ambil data terbaru untuk email
    $order = $order->fresh(); 

    // 4. Kirim email
    if ($order->customer_email) {
        \Illuminate\Support\Facades\Mail::to($order->customer_email)->send(new \App\Mail\OrderShippedMail($order));
    } else {
        \Illuminate\Support\Facades\Mail::to($order->user->email)->send(new \App\Mail\OrderShippedMail($order));
    }

    return redirect()->back()->with('success', 'Nomor resi diperbarui dan stok telah dikurangi!');
}
}