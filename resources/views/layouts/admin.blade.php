<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800 font-inter">

    <!-- NAVBAR ATAS -->
    <nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-30 top-0 h-16">
        <div class="px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center">
                    <!-- Logo / Brand -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <span class="text-xl font-bold text-indigo-900 tracking-tight">JerseyHolic<span class="text-indigo-400 text-sm font-normal ml-1">Admin</span></span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex flex-col text-right mr-2">
                        <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="text-xs text-gray-500">Super Admin</span>
                    </div>
                    
                    <!-- Form Logout -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 border border-red-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16 min-h-screen">
        <!-- SIDEBAR KIRI -->
        <aside class="w-64 bg-slate-900 text-white hidden md:block fixed h-full overflow-y-auto z-20">
            <div class="p-5">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Menu Utama</p>
                <nav class="space-y-2">
                    <!-- Link Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    
                    <!-- Link CRUD Jersey -->
                    <a href="{{ route('products.index') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('products.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('products.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Data Jersey
                    </a>
                </nav>

                <div class="my-6 border-t border-slate-700"></div>

                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Transaksi</p>
                <nav class="space-y-2">
                    
                    <!-- Link Pesanan Masuk -->
                    <a href="{{ route('orders.index') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('orders.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('orders.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Pesanan Masuk
                    </a>

                    <!-- Link Laporan (SUDAH DIAKTIFKAN) -->
                    <a href="{{ route('reports.index') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('reports.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('reports.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-1.5a2 2 0 012-2h2a2 2 0 012 2V17m-6 0a3 3 0 003 3h0a3 3 0 003-3m-6 0h6"></path></svg>
                        Laporan Penjualan
                    </a>
                </nav>
            </div>
            
            <!-- Footer Sidebar -->
            <div class="absolute bottom-0 w-full p-4 bg-slate-950">
                <p class="text-xs text-slate-500 text-center">JerseyHolic Admin v1.0 <br> Kelompok UTS 2025</p>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 md:ml-64 bg-gray-50 min-h-screen">
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>