<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
}