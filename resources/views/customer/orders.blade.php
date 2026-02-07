<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - E-JERSEY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 py-4 mb-8">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-xl font-bold text-indigo-900 tracking-tight">E-JERSEY</span>
            </a>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500 hidden sm:block">Halo, {{ Auth::user()->name }}</span>
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">Lanjut Belanja</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-red-600 font-bold text-sm hover:underline ml-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN -->
    <div class="max-w-6xl mx-auto px-4 pb-20">
        <h1 class="text-2xl font-bold mb-2 text-gray-900">Riwayat Pesanan</h1>
        <p class="text-gray-500 mb-6 text-sm">Daftar transaksi yang pernah Anda lakukan.</p>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @if($orders->isEmpty())
                <div class="text-center py-16">
                    <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Belum ada pesanan</h3>
                    <p class="text-gray-500 mb-6">Yuk mulai belanja jersey favoritmu!</p>
                    <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition">
                        Lihat Katalog
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-bold uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4">ID Order</th>
                                <th class="px-6 py-4">Produk</th>
                                <th class="px-6 py-4">Total Harga</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">
                                    #{{ $order->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <!-- Gambar Kecil -->
                                        <div class="w-10 h-10 bg-gray-200 rounded overflow-hidden flex-shrink-0">
                                            @if($order->product->image)
                                                <img src="{{ asset('storage/' . $order->product->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-500">IMG</div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $order->product->team_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $order->product->season }} (Size: {{ $order->size }}) x{{ $order->quantity }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-indigo-600">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border 
                                        {{ $order->status == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                        {{ $order->status == 'paid' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                        {{ $order->status == 'shipped' ? 'bg-purple-50 text-purple-700 border-purple-200' : '' }}
                                        {{ $order->status == 'done' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                        {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-700 border-red-200' : '' }}
                                    ">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</body>
</html>