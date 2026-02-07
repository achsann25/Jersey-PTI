<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- Ini penting!

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Memaksa HTTPS agar form login/register tidak error "Not Secure"
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
