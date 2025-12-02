<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-JERSEY - Pusat Jersey Original</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-pattern {
            background-color: #1e1b4b;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234f46e5' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 text-white p-1.5 rounded-lg font-bold text-xl">EJ</div>
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">E-JERSEY</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-indigo-600 font-semibold">Beranda</a>
                    <a href="#katalog" class="text-gray-600 hover:text-indigo-600 transition">Katalog</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-indigo-600 transition">Tentang Kami</a>
                </div>
               
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (BANNER) -->
    <section class="hero-pattern pt-32 pb-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-indigo-500/20 text-indigo-200 text-sm font-semibold mb-6 border border-indigo-500/30">
                Official Merchandise Store
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6">
                Wujudkan Tim Impian <br> dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Jersey Terbaik</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-10">
                Temukan koleksi jersey terlengkap dari liga-liga top dunia. Kualitas original, harga bersahabat, siap kirim ke seluruh Indonesia.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#katalog" class="px-8 py-4 bg-white text-indigo-900 rounded-full font-bold text-lg hover:bg-indigo-50 transition shadow-xl">
                    Lihat Koleksi
                </a>
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK -->
    <section id="katalog" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Katalog Pilihan</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mx-auto rounded-full"></div>
            </div>

            <!-- Grid Produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                <!-- Kartu Produk -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group flex flex-col h-full">
                    
                    <!-- Gambar Produk -->
                    <div class="relative h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->team_name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <span class="text-4xl font-bold text-gray-300">{{ substr($product->team_name, 0, 1) }}</span>
                        @endif
                        
                        <!-- Badge Stok -->
                        <div class="absolute top-4 right-4">
                            @if($product->stock > 0)
                                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Ready Stock</span>
                            @else
                                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Habis</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Info Produk -->
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="text-sm text-indigo-600 font-semibold mb-1">{{ $product->season }}</p>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $product->team_name }}</h3>
                            </div>
                        </div>
                        
                        <!-- Harga dan Tombol Beli -->
                        <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            
                            @if($product->stock > 0)
                                <!-- Tombol Beli (Link ke Checkout) -->
                                <a href="{{ route('checkout', $product->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition flex items-center gap-2">
                                    <span>Beli</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </a>
                            @else
                                <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg font-semibold cursor-not-allowed">
                                    Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-20">
                    <p class="text-gray-500 text-lg">Belum ada produk yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold mb-4">E-JERSEY</h2>
            <p class="text-gray-400 mb-8">Dibuat untuk memenuhi Tugas UTS Mata Kuliah PTI 2025.</p>
            <div class="text-sm text-gray-500">
                &copy; 2025 Kelompok Anda. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>