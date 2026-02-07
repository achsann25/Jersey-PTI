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
        // 1. Agar Laravel percaya dengan Proxy HTTPS Railway
        $middleware->trustProxies(at: '*'); 

        // 2. Memaksa Session agar selalu aktif di setiap request
        $middleware->append(\Illuminate\Session\Middleware\StartSession::class);

        // 3. Alias untuk Middleware Admin kamu
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // 4. MENGATASI ERROR 419: Kecualikan rute penting dari token CSRF
        $middleware->validateCsrfTokens(except: [
            '/midtrans-callback', 
            '/login',            
            '/admin/login',      
            '/register',         
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
