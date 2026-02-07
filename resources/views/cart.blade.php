<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar Simple -->
    <nav class="bg-white border-b border-gray-200 py-4 mb-8">
        <div class="max-w-4xl mx-auto px-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-2xl font-bold text-gray-900 tracking-tight">JerseyHolic</span>
            </a>
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600">Lanjut Belanja</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 pb-20">
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Keranjang Belanja Anda</h1>

        @if($carts->isEmpty())
            <!-- Tampilan Kosong -->
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Keranjang Masih Kosong</h2>
                <p class="text-gray-500 mb-6">Yuk isi dengan jersey impianmu!</p>
                <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">
                    Lihat Katalog
                </a>
            </div>
        @else
            <!-- Daftar Barang -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                @foreach($carts as $item)
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-6 border-b border-gray-100 last:border-0">
                    
                    <!-- Gambar -->
                    <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-bold text-gray-400 text-xs">No IMG</div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-gray-900">{{ $item->product->team_name }}</h3>
                        <p class="text-sm text-gray-500">{{ $item->product->season }}</p>
                        <div class="mt-1 flex items-center gap-2">
                            <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2 py-0.5 rounded">Size: {{ $item->size }}</span>
                            <span class="text-xs text-gray-500">Qty: {{ $item->quantity }}</span>
                        </div>
                    </div>

                    <!-- Harga & Hapus -->
                    <div class="text-right flex flex-row sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto mt-2 sm:mt-0">
                        <p class="font-bold text-indigo-600 text-lg">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                        
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="ml-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center gap-1 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Total & Checkout -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-600 font-medium">Total Pembayaran</span>
                    <span class="text-3xl font-extrabold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('checkout.cart') }}" class="w-full sm:w-auto text-center bg-indigo-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                        CHECKOUT SEMUA ({{ $carts->count() }})
                    </a>
                </div>
            </div>
        @endif
    </div>

</body>
</html>