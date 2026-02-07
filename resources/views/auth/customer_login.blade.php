<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - JerseyHolic Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- BAGIAN KIRI (Gambar/Banner) -->
        <div class="w-full md:w-1/2 bg-indigo-900 text-white p-10 flex flex-col justify-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h2>
                <p class="text-indigo-200 mb-6">Masuk untuk melanjutkan belanja, cek status pesanan, dan dapatkan promo terbaru.</p>
                <div class="flex gap-2">
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white opacity-50"></div>
                    <div class="w-2 h-2 rounded-full bg-white opacity-50"></div>
                </div>
            </div>
        </div>

        <!-- BAGIAN KANAN (Form) -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Masuk Akun</h1>
                <p class="text-sm text-gray-500">Silakan masukkan username dan password Anda</p>
            </div>

            <!-- Error Message -->
            @if($errors->any())
                <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm border border-red-100 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:border-transparent outline-none transition"
                        placeholder="Username Anda">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                    </div>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:border-transparent outline-none transition"
                        placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition transform hover:scale-[1.02] shadow-lg shadow-indigo-200">
                    MASUK SEKARANG
                </button>
            </form>

            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-600">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="inline-block mt-2 text-indigo-600 font-bold hover:underline">
                    Daftar Member Baru
                </a>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('admin.login') }}" class="text-xs text-gray-400 hover:text-gray-600">Login sebagai Admin</a>
            </div>
        </div>
    </div>

</body>
</html>