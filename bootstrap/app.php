<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Biar Railway (Proxy) dikenali aman oleh Laravel
        $middleware->trustProxies(at: '*'); 

        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // MENGATASI ERROR 419: Kecualikan rute penting dari validasi token CSRF
        $middleware->validateCsrfTokens(except: [
            '/midtrans-callback', 
            '/login',            // Tambahkan ini
            '/admin/login',      // Tambahkan ini
            '/register',         // Tambahkan ini
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
