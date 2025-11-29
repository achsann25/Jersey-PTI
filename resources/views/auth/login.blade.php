<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - E-JERSEY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <div class="flex min-h-screen">
        
        <!-- BAGIAN KIRI: GAMBAR (Hanya muncul di layar laptop/desktop) -->
        <!-- Kita pakai gambar stadion/bola biar sesuai tema Jersey -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900">
            <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?q=80&w=1920&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Soccer Stadium">
            
            <div class="relative z-10 w-full flex flex-col justify-center p-12 text-white">
                <h2 class="text-5xl font-bold mb-6">Manage Your<br>Dream Team.</h2>
                <p class="text-xl text-gray-200">Sistem Informasi Manajemen Stok Jersey Terlengkap </p>
                
                <div class="mt-10 flex gap-4">
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-lg border border-white/30">
                        <p class="font-bold text-2xl">100+</p>
                        <p class="text-sm">Jersey Club</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-lg border border-white/30">
                        <p class="font-bold text-2xl">24/7</p>
                        <p class="text-sm">Realtime System</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BAGIAN KANAN: FORM LOGIN -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                
                <!-- Header Form -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4 text-indigo-600">
                        <!-- Icon Kunci -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Welcome Back!</h1>
                    <p class="text-gray-500 mt-2">Silakan login untuk masuk ke Dashboard Admin.</p>
                </div>

                <!-- ALERT: Info Kredensial (Biar Dosen Gampang Login) -->
                <div class="mb-6 bg-blue-50 border-l-4 border-blue-600 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800 font-bold">Akun Wajib UTS:</p>
                            <p class="text-sm text-blue-700">Username: <span class="font-mono bg-blue-200 px-1 rounded">admin</span></p>
                            <p class="text-sm text-blue-700">Password: <span class="font-mono bg-blue-200 px-1 rounded">admin1234</span></p>
                        </div>
                    </div>
                </div>

                <!-- ALERT: Error Message (Jika Salah Password) -->
                @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Form Start -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Username Input -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="username" id="username" required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm placeholder-gray-400" 
                                placeholder="Masukkan username admin">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" required 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm placeholder-gray-400" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-[1.02]">
                        MASUK KE DASHBOARD
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        &copy; 2025 E-JERSEY Project UTS. <br> JerseyKita.
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>