<?php

namespace App\App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     * 1. LOGIN CUSTOMER (Default: /login)
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }
        
        return view('auth.customer_login');
    }

    /**
     * 2. LOGIN ADMIN (Khusus: /admin/login)
     */
    public function showAdminLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('auth.login'); 
    }

    /**
     * 3. PROSES LOGIN (Dipakai oleh Customer & Admin)
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
            
            // Logika Proteksi Pintu Admin vs Customer
            if ($request->is('admin/*') || $request->is('admin/login')) {
                 if ($user->role !== 'admin') {
                     Auth::logout();
                     return back()->withErrors(['username' => 'Akses ditolak! Halaman ini hanya untuk Pegawai/Admin.']);
                 }
            } else {
                 if ($user->role !== 'customer') {
                     Auth::logout();
                     return back()->withErrors(['username' => 'Akun Pegawai silakan login melalui pintu khusus.']);
                 }
            }

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // 3. Redirect ke tempat yang sesuai (Gunakan intended agar tidak mental ke home terus)
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } 
            
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'username' => 'Login Gagal! Username atau Password salah.',
        ])->onlyInput('username');
    }

    /**
     * 4. REGISTER (Hanya untuk Customer)
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * 5. PROSES REGISTER
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:50',
            'email'    => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed' 
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer' 
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Registrasi berhasil! Selamat datang.');
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * 6. LOGOUT
     */
    public function logout(Request $request)
    {
        $role = Auth::check() ? Auth::user()->role : 'customer';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($role === 'admin') {
            return redirect()->route('admin.login');
        }

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
