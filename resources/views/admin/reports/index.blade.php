@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Penjualan</h1>
            <p class="text-gray-600 text-sm">Ringkasan performa penjualan dan transaksi yang telah selesai.</p>
        </div>
        
        <!-- Tombol Cetak (Opsional/Placeholder) -->
        <button onclick="window.print()" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-lg shadow-sm transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Laporan
        </button>
    </div>

    <!-- 1. KARTU STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Omzet -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Pendapatan (Omzet)</p>
                    <h3 class="text-3xl font-bold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="p-2 bg-green-50 rounded-lg text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Item Terjual -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Jersey Terjual</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $itemsSold }} <span class="text-lg font-normal text-gray-400">Pcs</span></h3>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Transaksi Sukses -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Transaksi Selesai</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalTransactions }} <span class="text-lg font-normal text-gray-400">Kali</span></h3>
                </div>
                <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. TABEL RIWAYAT TRANSAKSI -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Riwayat Penjualan Terakhir</h3>
            <span class="text-xs text-gray-500 bg-white border border-gray-300 px-2 py-1 rounded">10 Transaksi Terakhir</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase font-bold text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">ID Order</th>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3 text-right">Total Bayar</th>
                        <th class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentSales as $sale)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-500">
                            {{ $sale->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 font-mono text-indigo-600 font-bold">
                            #{{ $sale->id }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-800">{{ $sale->customer_name }}</p>
                            <p class="text-xs text-gray-500">{{ $sale->address }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-700">{{ $sale->product->team_name }}</span>
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-0.5 rounded-full">x{{ $sale->quantity }}</span>
                            </div>
                            <p class="text-xs text-gray-500">{{ $sale->product->season }}</p>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-green-600">
                            Rp {{ number_format($sale->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                SELESAI
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="h-10 w-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p>Belum ada data penjualan yang selesai.</p>
                                <p class="text-xs mt-1">Selesaikan pesanan di menu "Pesanan Masuk" agar muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection