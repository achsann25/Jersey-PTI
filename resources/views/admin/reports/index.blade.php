@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md border print:shadow-none print:border-none">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">Laporan Penjualan JerseyHolic</h1>
            <p class="text-sm text-gray-500">Data per tanggal: {{ date('d F Y') }}</p>
        </div>
        <button onclick="window.print()" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg print:hidden flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Laporan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="p-5 bg-blue-50 border border-blue-100 rounded-xl">
            <p class="text-xs font-bold text-blue-500 uppercase">Total Transaksi</p>
            <p class="text-2xl font-black text-blue-900">{{ $totalTransactions }}</p>
        </div>
        <div class="p-5 bg-green-50 border border-green-100 rounded-xl">
            <p class="text-xs font-bold text-green-500 uppercase">Total Pendapatan</p>
            <p class="text-2xl font-black text-green-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="p-5 bg-purple-50 border border-purple-100 rounded-xl">
            <p class="text-xs font-bold text-purple-500 uppercase">Jersey Terjual</p>
            <p class="text-2xl font-black text-purple-900">{{ $itemsSold }} Pcs</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="py-4 px-3 text-sm font-bold text-gray-600">ID</th>
                    <th class="py-4 px-3 text-sm font-bold text-gray-600">Produk</th>
                    <th class="py-4 px-3 text-sm font-bold text-gray-600">Pelanggan</th>
                    <th class="py-4 px-3 text-sm font-bold text-gray-600">Size</th>
                    <th class="py-4 px-3 text-sm font-bold text-gray-600">Qty</th>
                    <th class="py-4 px-3 text-sm font-bold text-gray-600">Status</th>
                    <th class="py-4 px-3 text-sm font-bold text-gray-600 text-right">Total Harga</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($recentSales as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-4 px-3 text-sm">#{{ $order->id }}</td>
                    <td class="py-4 px-3 text-sm font-semibold">{{ $order->product->team_name ?? 'Produk Dihapus' }}</td>
                    <td class="py-4 px-3 text-sm text-gray-600">{{ $order->customer_name }}</td>
                    <td class="py-4 px-3 text-sm font-bold">{{ $order->size }}</td>
                    <td class="py-4 px-3 text-sm">{{ $order->quantity }}</td>
                    <td class="py-4 px-3 text-xs">
                        <span class="px-2 py-1 rounded-full font-bold uppercase 
                            {{ $order->status == 'pending' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="py-4 px-3 text-sm font-bold text-right">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
@media print {
    body { background: white !important; }
    nav, aside, .print:hidden, button { display: none !important; }
    .p-6 { padding: 0 !important; }
}
</style>
@endsection
