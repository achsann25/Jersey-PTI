<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $size = $request->query('size', 'M');
        $shipping_rates = DB::table('shipping_rates')->get();
        return view('checkout', compact('product', 'size', 'shipping_rates'));
    }

    public function history()
    {
        try {
            $orders = Order::where('user_id', Auth::id())
                            ->with('product')
                            ->orderBy('created_at', 'desc')
                            ->get();
        } catch (\Exception $e) {
            $orders = Order::with('product')->orderBy('created_at', 'desc')->get();
        }
        return view('order_history', compact('orders'));
    }

    public function repay($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'INV-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'phone' => $order->customer_whatsapp,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return view('payment', compact('snapToken', 'order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_whatsapp' => 'required',
            'address' => 'required',
            'shipping_cost' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;
        $total = ($product->price * $quantity) + $request->shipping_cost;

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_whatsapp' => $request->customer_whatsapp,
            'address' => $request->address,
            'quantity' => $quantity,
            'size' => $request->size,
            'shipping_cost' => $request->shipping_cost,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'INV-' . $order->id . '-' . time(),
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_whatsapp,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return view('payment', compact('snapToken', 'order'));
    }

    /**
     * Jalur otomatis Midtrans mengupdate status pesanan.
     */
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // Midtrans kirim order_id format: INV-ID-TIME
                $orderParts = explode('-', $request->order_id);
                $idDatabase = $orderParts[1]; 
                
                $order = Order::find($idDatabase);
                if ($order) {
                    $order->update(['status' => 'paid']);
                }
            }
        }
    }

    public function markAsDone($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum dikirim.');
        }
        $order->update(['status' => 'done']);
        return back()->with('success', 'Pesanan selesai!');
    }
}
