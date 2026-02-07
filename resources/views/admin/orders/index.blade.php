@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Manajemen Pesanan</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Order ID</th>
                    <th class="py-3 px-6 text-left">Pelanggan</th>
                    <th class="py-3 px-6 text-left">Produk</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Nomor Resi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($orders as $order)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left">#{{ $order->id }}</td>
                    <td class="py-3 px-6 text-left">
                        <div class="font-medium text-gray-900">{{ $order->customer_name }}</div>
                        <div class="text-xs text-gray-500">{{ $order->customer_whatsapp }}</div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $order->product->team_name }} ({{ $order->size }}) x {{ $order->quantity }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if($order->status == 'paid')
                            <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold italic uppercase">Lunas</span>
                        @elseif($order->status == 'shipped')
                            <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full text-xs font-bold italic uppercase">Dikirim</span>
                        @else
                            <span class="bg-amber-100 text-amber-700 py-1 px-3 rounded-full text-xs font-bold italic uppercase">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if($order->status == 'paid' || $order->status == 'shipped')
                        <form action="{{ route('orders.update_resi', $order->id) }}" method="POST" class="flex items-center justify-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="tracking_number" value="{{ $order->tracking_number }}" 
                                   class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-indigo-200 outline-none w-32" 
                                   placeholder="Input Resi..." required>
                            <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition text-xs font-bold">
                                Update
                            </button>
                        </form>
                        @else
                        <span class="text-gray-400 italic">Menunggu Pembayaran</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection