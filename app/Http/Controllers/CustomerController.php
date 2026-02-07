<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil pesanan milik user yang sedang login saja
        $orders = Order::where('user_id', Auth::id())
                       ->with('product')
                       ->latest()
                       ->get();

        return view('customer.orders', compact('orders'));
    }
}
