@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Transaksi Masuk</h1>

<div class="bg-white rounded-xl shadow p-4 overflow-x-auto">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-100 text-gray-600 uppercase font-bold">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Pelanggan</th>
                <th class="px-4 py-3">Produk</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Bukti</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3">#{{ $order->id }}</td>
                <td class="px-4 py-3">
                    <p class="font-bold">{{ $order->customer_name }}</p>
                    <p class="text-xs text-gray-500">{{ $order->customer_whatsapp }}</p>
                </td>
                <td class="px-4 py-3">{{ $order->product->team_name }} (x{{ $order->quantity }})</td>
                <td class="px-4 py-3 font-bold text-indigo-600">Rp {{ number_format($order->total_price) }}</td>
                <td class="px-4 py-3">
                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs font-bold 
                        {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $order->status == 'paid' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-purple-100 text-purple-800' : '' }}
                        {{ $order->status == 'done' ? 'bg-green-100 text-green-800' : '' }}
                    ">
                        {{ strtoupper($order->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="border rounded p-1 text-xs">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                            <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection