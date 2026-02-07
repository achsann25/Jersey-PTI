<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition">Beranda</a>
                    <a href="{{ route('home') }}#katalog" class="text-gray-600 hover:text-indigo-600 transition">Katalog</a>
                    <a href="#" class="text-indigo-600 font-semibold">Tentang Kami</a>
                </div>
                
            </div>
        </div>
    </nav>

    <!-- HEADER SECTION -->
    <section class="pt-32 pb-16 bg-indigo-900 text-white text-center relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
        
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <span class="uppercase tracking-widest text-indigo-300 text-sm font-bold mb-2 block">Kelompok PTI 2025</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Tim Pengembang JerseyHolic</h1>
            <p class="text-indigo-200 text-lg max-w-2xl mx-auto">
                Kami adalah tim beranggotakan 5 mahasiswa yang yang kebetulan mengaplikasikan kesukaan bola terhadap tugas UTS PTI.
            </p>
        </div>
    </section>

    <!-- TEAM MEMBERS SECTION -->
    <section class="py-20 -mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Grid Anggota Tim -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full mx-auto flex items-center justify-center mb-6 text-4xl shadow-lg">
                        👨‍💻
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Achmad Chasanuddin</h3>
                    <p class="text-indigo-600 font-medium mb-1">NIM: 10123367</p>
                    <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full mb-4">Project Manager</span>
                    <div class="pt-4 border-t border-gray-100 text-sm text-gray-500">
                        "Bertanggung jawab atas setup awal Laravel, konfigurasi server, serta perancangan Database (ERD, Migrasi, Seeder)."
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full mx-auto flex items-center justify-center mb-6 text-4xl shadow-lg">
                        ⚙️
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">M Iqbal Noor Iskandar</h3>
                    <p class="text-indigo-600 font-medium mb-1">NIM: 10123366</p>
                    <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-full mb-4">Backend Core</span>
                    <div class="pt-4 border-t border-gray-100 text-sm text-gray-500">
                        "Membangun fitur inti Admin seperti Login/Auth, serta logika CRUD Produk (Controller & Model)."
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-teal-500 rounded-full mx-auto flex items-center justify-center mb-6 text-4xl shadow-lg">
                        🛒
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Gerald Jordan B. S.</h3>
                    <p class="text-indigo-600 font-medium mb-1">NIM: 10123378</p>
                    <span class="inline-block px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full mb-4">Backend Transaction</span>
                    <div class="pt-4 border-t border-gray-100 text-sm text-gray-500">
                        "Menangani logika transaksi Checkout, upload bukti bayar, manajemen status pesanan, dan fitur Pelaporan."
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-2 lg:col-start-1 lg:ml-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-pink-500 to-rose-500 rounded-full mx-auto flex items-center justify-center mb-6 text-4xl shadow-lg">
                        🎨
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Desta Adi Nugraha</h3>
                    <p class="text-indigo-600 font-medium mb-1">NIM: 10123353</p>
                    <span class="inline-block px-3 py-1 bg-pink-50 text-pink-700 text-xs font-bold rounded-full mb-4">Frontend Public</span>
                    <div class="pt-4 border-t border-gray-100 text-sm text-gray-500">
                        "Mendesain antarmuka pengguna (UI) untuk Landing Page, Katalog, Detail Produk, dan Halaman Checkout."
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-2 lg:col-start-2 lg:mr-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-amber-500 rounded-full mx-auto flex items-center justify-center mb-6 text-4xl shadow-lg">
                        📊
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Ridho Pambudi Utomo</h3>
                    <p class="text-indigo-600 font-medium mb-1">NIM: 10123372</p>
                    <span class="inline-block px-3 py-1 bg-orange-50 text-orange-700 text-xs font-bold rounded-full mb-4">Frontend Admin</span>
                    <div class="pt-4 border-t border-gray-100 text-sm text-gray-500">
                        "Mengembangkan layout Dashboard Admin, Sidebar, serta styling tabel dan formulir manajemen data."
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="py-16 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                
                <!-- Deskripsi Proyek -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang Aplikasi</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        <strong>JerseyHolic</strong> adalah aplikasi berbasis web yang dirancang untuk memudahkan pengelolaan stok dan penjualan jersey sepak bola. Aplikasi ini dibangun menggunakan framework modern untuk memastikan performa yang cepat dan tampilan yang responsif.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Fitur utama aplikasi ini mencakup manajemen produk (CRUD), transaksi pemesanan langsung, serta laporan penjualan otomatis untuk admin.
                    </p>
                    
                    <h3 class="font-bold text-gray-900 mb-3">Teknologi yang Digunakan:</h3>
                    <ul class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Laravel 12 (PHP)</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> MySQL / MariaDB</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Tailwind CSS</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Blade Template Engine</li>
                    </ul>
                </div>

                <!-- Fitur Unggulan -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Fitur Unggulan</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Manajemen Stok (CRUD)</h4>
                                <p class="text-sm text-gray-600">Admin dapat menambah, mengedit, dan menghapus data jersey dengan mudah.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-green-100 p-2 rounded-lg text-green-600 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Pemesanan Langsung</h4>
                                <p class="text-sm text-gray-600">Customer dapat memesan langsung dan melakukan upload bukti pembayaran.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-purple-100 p-2 rounded-lg text-purple-600 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Laporan & Analitik</h4>
                                <p class="text-sm text-gray-600">Admin dapat memantau omzet, item terjual, dan riwayat transaksi secara real-time.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-8 text-center">
        <p class="text-gray-400 text-sm">
            &copy; 2025 Kelompok JerseyHolic. Universitas Komputer Indonesia.
        </p>
    </footer>

</body>
</html>