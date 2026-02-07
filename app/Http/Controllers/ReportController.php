<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dari request (default bulan sekarang)
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        // Ambil data penjualan yang sudah bayar, dikelompokkan per produk
        $salesData = Order::with('product')
            ->select('product_id', 
                DB::raw('SUM(quantity) as total_qty'), 
                DB::raw('SUM(total_price) as total_revenue'))
            ->whereIn('status', ['paid', 'shipped', 'done'])
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('product_id')
            ->get();

        $grandTotalRevenue = $salesData->sum('total_revenue');
        $grandTotalQty = $salesData->sum('total_qty');

        return view('admin.reports.index', compact('salesData', 'grandTotalRevenue', 'grandTotalQty', 'month', 'year'));
    }
}
