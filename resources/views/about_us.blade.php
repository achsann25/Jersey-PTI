<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - E-JERSEY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR (Sama seperti Landing Page) -->
    <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="bg-indigo-600 text-white p-1.5 rounded-lg font-bold text-xl">EJ</div>
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">E-JERSEY</span>
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
    <section class="pt-32 pb-12 bg-indigo-900 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Tim Pengembang</h1>
            <p class="text-indigo-200 text-lg">
                Proyek ini dibuat untuk memenuhi Tugas Ujian Tengah Semester (UTS)<br>
                Mata Kuliah Penerapan Teknologi Internet (PTI).
            </p>
        </div>
    </section>

    <!-- TEAM MEMBERS SECTION -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid Anggota Tim -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                
                <!-- ANGGOTA 1 (GANTI DATA DI SINI) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="w-24 h-24 bg-indigo-100 rounded-full mx-auto flex items-center justify-center mb-6 text-3xl">
                        👨‍💻 <!-- Bisa diganti <img> foto asli -->
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Achmad Chasanuddin</h3>
                    <p class="text-indigo-600 font-medium mb-2">NIM: 10123367</p>
                    <p class="text-gray-500 text-sm">-</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">Bertanggung jawab atas </p>
                    </div>
                </div>

                <!-- ANGGOTA 2 (GANTI DATA DI SINI) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="w-24 h-24 bg-purple-100 rounded-full mx-auto flex items-center justify-center mb-6 text-3xl">
                        👩‍💻
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Gerald Jordan B. S.</h3>
                    <p class="text-indigo-600 font-medium mb-2">NIM: 10123378</p>
                    <p class="text-gray-500 text-sm">-</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">Bertanggung jawab atas </p>
                    </div>
                </div>

                <!-- ANGGOTA 3 (GANTI DATA DI SINI) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="w-24 h-24 bg-pink-100 rounded-full mx-auto flex items-center justify-center mb-6 text-3xl">
                        🎨
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">M Iqbal Noor I.</h3>
                    <p class="text-indigo-600 font-medium mb-2">NIM: 10123366</p>
                    <p class="text-gray-500 text-sm">-</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">Bertanggung jawab atas .</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="w-24 h-24 bg-pink-100 rounded-full mx-auto flex items-center justify-center mb-6 text-3xl">
                        🎨
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Ridho Pambudi U</h3>
                    <p class="text-indigo-600 font-medium mb-2">NIM: 10123372</p>
                    <p class="text-gray-500 text-sm">-</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">Bertanggung jawab atas .</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="w-24 h-24 bg-pink-100 rounded-full mx-auto flex items-center justify-center mb-6 text-3xl">
                        🎨
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Desta Adi N.</h3>
                    <p class="text-indigo-600 font-medium mb-2">NIM: 10123353</p>
                    <p class="text-gray-500 text-sm">-</p>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400">Bertanggung jawab atas .</p>
                    </div>
                </div>

                <!-- Tambahkan blok div lagi di sini jika anggota > 3 -->

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 py-8 text-center">
        <p class="text-gray-500 text-sm">
            &copy; 2025 Kelompok E-JERSEY. Universitas Komputer Indonesia.
        </p>
    </footer>

</body>
</html>