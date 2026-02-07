<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JerseyHolic - Pusat Jersey Original</title>
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

    <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">JerseyHolic</span>
                </div>

                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-indigo-600 font-semibold">Beranda</a>
                    <a href="#katalog" class="text-gray-600 hover:text-indigo-600 transition">Katalog</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-indigo-600 transition">Tentang Kami</a>
                </div>

                <div class="flex items-center gap-4">
                    
                    @auth
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 font-medium bg-gray-100 px-4 py-2 rounded-full transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        @else
                            <div class="flex items-center gap-3">
                                <a href="{{ route('order.history') }}" class="text-gray-600 hover:text-indigo-600 transition p-2 rounded-full hover:bg-indigo-50" title="Pesanan Saya">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </a>
                                
                                <div class="flex items-center gap-2 border-l pl-3 border-gray-300">
                                    <span class="text-sm font-bold text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium ml-2">
                                            (Logout)
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition group" title="Login / Masuk">
                            <div class="p-2 rounded-full bg-gray-100 group-hover:bg-indigo-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="font-medium hidden sm:block">Masuk / Daftar</span>
                        </a>
                    @endauth

                </div>
            </div>
        </div>
    </nav>

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
                @auth
                    @if(Auth::user()->role == 'customer')
                    <a href="{{ route('order.history') }}" class="px-8 py-4 bg-indigo-500/20 text-white border border-indigo-400/30 rounded-full font-bold text-lg hover:bg-indigo-500/40 transition">
                        Pesanan Saya 📦
                    </a>
                    @endif
                @endauth
            </div>
        </div>
    </section>

    <section id="katalog" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Katalog Pilihan</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mx-auto rounded-full mb-8"></div>
                
                <div class="max-w-xl mx-auto relative">
                    <form action="{{ route('home') }}" method="GET">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Cari tim favoritmu (contoh: Madrid)..." 
                                class="w-full px-6 py-4 rounded-full border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition shadow-sm text-gray-700 pr-32">
                            
                            <button type="submit" class="absolute top-2 right-2 bottom-2 bg-indigo-600 text-white px-6 rounded-full font-bold hover:bg-indigo-700 transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group flex flex-col h-full">
                    <div class="relative h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->team_name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <span class="text-4xl font-bold text-gray-300">{{ substr($product->team_name, 0, 1) }}</span>
                        @endif
                        <div class="absolute top-4 right-4">
                            @if($product->stock > 0)
                                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Ready Stock</span>
                            @else
                                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Habis</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-2">
                            <p class="text-sm text-indigo-600 font-semibold mb-1">{{ $product->season }}</p>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $product->team_name }}</h3>
                        </div>
                        <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('product.show', $product->id) }}" class="px-4 py-2 bg-white border border-indigo-600 text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition flex items-center gap-2">
                                <span>Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-20">
                    <p class="text-gray-500">Jersey tidak ditemukan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold mb-4">JerseyHolic</h2>
            <p class="text-gray-400 mb-8">Dibuat untuk memenuhi Tugas UTS Mata Kuliah PTI 2025.</p>
            <div class="text-sm text-gray-500">&copy; 2025 Kelompok Anda. All rights reserved.</div>
        </div>
    </footer>
</body>
</html>