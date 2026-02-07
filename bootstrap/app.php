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
        // 1. Agar HTTPS Railway dikenali dengan benar
        $middleware->trustProxies(at: '*'); 

        // 2. Prioritaskan Session agar login tidak 'mental'
        $middleware->priority([
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\IsAdmin::class,
        ]);

        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // 3. Matikan CSRF untuk testing login jika masih macet (Opsional tapi membantu)
        $middleware->validateCsrfTokens(except: [
            '/admin/login',
            '/login'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
