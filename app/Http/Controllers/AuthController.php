<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * 1. LOGIN CUSTOMER (Default: /login)
     * Menampilkan form login untuk pelanggan umum.
     */
    public function showLoginForm()
    {
        // Jika sudah login, cek role untuk redirect yang benar
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }
        
        // Tampilkan view login khusus Customer (yang desainnya beda)
        // Pastikan Anda sudah membuat file: resources/views/auth/customer_login.blade.php
        return view('auth.customer_login');
    }

    /**
     * 2. LOGIN ADMIN (Khusus: /admin/login)
     * Menampilkan form login khusus admin (tampilan lama).
     */
    public function showAdminLoginForm()
    {
        // Jika sudah login, langsung lempar ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        
        // Tampilkan view login Admin (yang ada info kredensial UTS)
        return view('auth.login'); 
    }

    /**
     * 3. PROSES LOGIN (Dipakai oleh Customer & Admin)
     * Menerima input dari kedua form login di atas.
     */
   public function login(Request $request)
{
    // 1. Validasi Input
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // 2. Coba Login
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        // --- TAMBAHKAN LOGIKA PROTEKSI DI SINI ---
        
        // Jika login dari halaman ADMIN (/admin/login)
        if ($request->is('admin/*') || $request->is('admin/login')) {
             if ($user->role !== 'admin') {
                 Auth::logout(); // Paksa keluar jika bukan admin
                 return back()->withErrors(['username' => 'Akses ditolak! Halaman ini hanya untuk Pegawai/Admin.']);
             }
        } 
        
        // Jika login dari halaman CUSTOMER (pintu biasa)
        else {
             if ($user->role !== 'customer') {
                 // Opsional: Admin boleh login di depan, atau mau dilarang juga?
                 // Kalau mau dilarang seperti keinginanmu:
                 Auth::logout();
                 return back()->withErrors(['username' => 'Akun Pegawai silakan login melalui pintu khusus.']);
             }
        }

        $request->session()->regenerate();

        // 3. Redirect ke tempat yang sesuai
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        return redirect()->route('home');
    }

    return back()->withErrors([
        'username' => 'Login Gagal! Username atau Password salah.',
    ])->onlyInput('username');
}
    /**
     * 4. REGISTER (Hanya untuk Customer)
     * Menampilkan form pendaftaran.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * 5. PROSES REGISTER
     * Membuat akun baru dengan role 'customer'.
     */
    public function register(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:50',
            'email'    => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed' // Wajib ada input name="password_confirmation" di view
        ]);

        // Simpan User Baru
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer' // Default role selalu customer
        ]);

        // OPSI: Auto Login setelah register (Bagus untuk UX)
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang.');
        }

        // Jika tidak auto login, lempar ke halaman login
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * 6. LOGOUT
     * Keluar dari sistem.
     */
  public function logout(Request $request)
{
    // 1. Simpan role user sebelum logout untuk menentukan arah redirect
    $role = Auth::check() ? Auth::user()->role : 'customer';

    // 2. Proses Logout standar Laravel
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 3. LOGIKA REDIRECT PINTAR
    // Jika yang logout tadi adalah admin, arahkan ke login admin
    if ($role === 'admin') {
        return redirect()->route('admin.login');
    }

    // Jika customer, arahkan ke halaman utama atau login customer
    return redirect('/')->with('success', 'Berhasil logout!');
}
}