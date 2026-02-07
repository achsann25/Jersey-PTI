<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <div class="flex min-h-screen">
    
        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900">
<img src="{{ asset('img/bglogin.jpeg') }}" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Soccer Stadium">
            
            <div class="relative z-10 w-full flex flex-col justify-center p-12 text-white">
                <h2 class="text-5xl font-bold mb-6">Manage Your<br>Dream Team.</h2>
                <p class="text-xl text-gray-200">Sistem Informasi Manajemen Stok Jersey</p>
                
                <div class="mt-10 flex gap-4">
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-lg border border-white/30">
                        <p class="font-bold text-2xl">UTS</p>
                        <p class="text-sm">PTI 2025</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-lg border border-white/30">
                        <p class="font-bold text-2xl">JerseyHolic</p>
                        <p class="text-sm">sistem</p>
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

                

                <!-- ALERT: Error Message (Jika Salah Password) -->
                @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $errors->first() }}
                </div>
                @endif

                <!-- Form Start -->
                <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
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
                        &copy; 2025 JerseyHolic Project UTS. <br> 
                    </p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>