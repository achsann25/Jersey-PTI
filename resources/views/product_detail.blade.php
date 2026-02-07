<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->team_name }} - Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">JerseyHolic</span>
                </a>
                
                <div class="flex items-center gap-6">
                    <!-- Tombol Lihat Keranjang -->
                    <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-indigo-600 transition relative group" title="Lihat Keranjang">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full opacity-0 group-hover:opacity-100 transition">Lihat</span>
                    </a>

                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition font-medium text-sm">
                        &larr; Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- DETAIL PRODUK SECTION -->
    <section class="pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    
                    <!-- KIRI: FOTO PRODUK -->
                    <div class="bg-gray-100 flex items-center justify-center p-10 h-full min-h-[400px]">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->team_name }}" class="max-h-[400px] w-auto object-contain drop-shadow-2xl hover:scale-105 transition duration-500">
                        @else
                            <div class="text-center">
                                <span class="text-9xl font-bold text-gray-300 block mb-4">{{ substr($product->team_name, 0, 1) }}</span>
                                <span class="text-gray-400">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <!-- KANAN: INFORMASI & FORM -->
                    <div class="p-10 lg:p-14 flex flex-col justify-center">
                        <span class="inline-block py-1 px-3 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold mb-4 w-fit">
                            MUSIM {{ $product->season }}
                        </span>
                        
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $product->team_name }}</h1>
                        
                        <div class="flex items-end gap-4 mb-6 border-b border-gray-100 pb-6">
                            <p class="text-4xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            @if($product->stock > 0)
                                <span class="text-green-600 font-semibold mb-1 flex items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Stok: {{ $product->stock }}
                                </span>
                            @else
                                <span class="text-red-600 font-semibold mb-1">Stok Habis</span>
                            @endif
                        </div>

                        <div class="space-y-4 mb-8">
                            <p class="text-gray-600 leading-relaxed">
                                Dapatkan jersey {{ $product->team_name }} musim {{ $product->season }} dengan kualitas terbaik. 
                                Bahan nyaman, menyerap keringat, dan cocok untuk dipakai olahraga maupun santai.
                            </p>
                        </div>

                        <!-- FORM UTAMA -->
                        <!-- Action default mengarah ke Keranjang -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            
                            @if($product->stock > 0)
                                <!-- 1. Pilihan Ukuran -->
                                <div class="mb-6">
                                    <label class="block font-bold text-gray-800 mb-3">Pilih Ukuran:</label>
                                    <div class="flex gap-3">
                                        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="size" value="{{ $size }}" class="peer sr-only" {{ $size == 'L' ? 'checked' : '' }}>
                                                <div class="w-12 h-12 flex items-center justify-center rounded-lg border-2 border-gray-200 text-gray-500 font-bold peer-checked:border-indigo-600 peer-checked:bg-indigo-50 peer-checked:text-indigo-600 hover:border-indigo-300 transition">
                                                    {{ $size }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- 2. Input Quantity -->
                                <div class="mb-8 w-32">
                                    <label class="block font-bold text-gray-800 mb-2">Jumlah:</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full border-2 border-gray-200 rounded-lg p-2 text-center font-bold focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                                </div>

                                <!-- 3. Tombol Aksi -->
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <!-- Tombol Masuk Keranjang (Submit Form) -->
                                    <button type="submit" class="flex-1 bg-white border-2 border-gray-900 text-gray-900 font-bold py-4 rounded-xl hover:bg-gray-100 transition flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        + KERANJANG
                                    </button>

                                    <!-- Tombol Beli Langsung -->
                                    <!-- Menggunakan Javascript sederhana untuk mengambil nilai size yang dipilih dan pindah ke halaman checkout -->
                                    <a href="#" onclick="event.preventDefault(); window.location.href='{{ route('checkout', $product->id) }}?size=' + document.querySelector('input[name=size]:checked').value;" 
                                       class="flex-1 bg-indigo-600 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-indigo-700 transition text-center flex items-center justify-center">
                                        BELI SEKARANG
                                    </a>
                                </div>
                            @else
                                <!-- Tampilan Jika Stok Habis -->
                                <button type="button" disabled class="block w-full bg-gray-200 text-gray-400 font-bold py-4 rounded-xl cursor-not-allowed">
                                    STOK HABIS
                                </button>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 py-8 text-center mt-auto">
        <p class="text-gray-500 text-sm">
            &copy; 2025 JerseyHolic. All rights reserved.
        </p>
    </footer>

</body>
</html>