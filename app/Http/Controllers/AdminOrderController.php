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
    
    // 1. Update database dulu (biar data aman)
    $order->update([
        'status' => 'shipped',
        'resi' => $request->resi
    ]);

    // 2. Kirim Email dengan proteksi Try-Catch
    try {
        \Illuminate\Support\Facades\Mail::to($order->customer_email)
            ->send(new \App\Mail\ShippingNotification($order));
            
        return back()->with('success', 'Resi berhasil diupdate dan email notifikasi terkirim!');
    } catch (\Exception $e) {
        // Jika gagal konek SMTP, tetap balik ke halaman sebelumnya tapi kasih tau errornya
        return back()->with('success', 'Resi berhasil diupdate, tapi email gagal dikirim (Cek koneksi SMTP).');
    }
}
}
