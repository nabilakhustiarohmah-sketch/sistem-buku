<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Jika berjalan di Vercel, paksa jalur kompilasi Blade View ke folder /tmp
        if (isset($_SERVER['VERCEL_JOB_ID']) || isset($_SERVER['NOW_REGION'])) {
            $viewCachePath = '/tmp/storage/framework/views';
            if (!file_exists($viewCachePath)) {
                mkdir($viewCachePath, 0755, true);
            }
            $this->app['config']->set('view.compiled', $viewCachePath);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}