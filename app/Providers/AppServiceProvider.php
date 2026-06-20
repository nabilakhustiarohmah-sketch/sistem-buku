<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Kosongkan bagian ini
    }

    /**
     * Bootstrap any application services.
     */
/**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pindahkan ke boot() agar konfigurasi config aman diubah saat runtime Vercel
        if (isset($_SERVER['VERCEL_JOB_ID']) || isset($_SERVER['NOW_REGION'])) {
            $viewCachePath = '/tmp/storage/framework/views';
            if (!file_exists($viewCachePath)) {
                mkdir($viewCachePath, 0755, true);
            }
            
            // GANTI BARIS YANG MERAH TADI DENGAN FUNGSI INI:
            config(['view.compiled' => $viewCachePath]);
        }
    }
}