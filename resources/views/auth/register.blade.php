<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - E-JERSEY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-indigo-700 mb-6">Daftar Member Baru</h2>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border p-2 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" required class="w-full border p-2 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full border p-2 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full border p-2 rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full border p-2 rounded-lg">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-lg hover:bg-indigo-700">DAFTAR SEKARANG</button>
        </form>
        
        <p class="text-center mt-4 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 font-bold">Login</a></p>
    </div>

</body>
</html>