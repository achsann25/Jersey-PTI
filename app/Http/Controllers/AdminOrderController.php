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
    $request->validate([
        'resi' => 'required'
    ]);

    $order = \App\Models\Order::findOrFail($id);
    
    // 1. Update database dulu
    $order->update([
        'status' => 'shipped',
        'resi' => $request->resi
    ]);

    // 2. Kirim Email - Pastikan memanggil OrderShippedMail
    try {
        Mail::to($order->customer_email)
            ->send(new OrderShippedMail($order)); // SINKRONKAN DISINI
            
        return back()->with('success', 'Resi berhasil diupdate dan email notifikasi terkirim!');
    } catch (\Exception $e) {
        // Log error untuk debug di Railway Logs
        \Log::error("Mail Error: " . $e->getMessage());
        
        return back()->with('success', 'Resi berhasil diupdate, tapi email gagal dikirim (Cek koneksi SMTP).');
    }
}
}
