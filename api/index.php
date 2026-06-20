<?php

// 1. Jalankan core autoload Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 2. PAKSA CONFIG LOGGING SECARA HARDCODE (Menghancurkan sisa-sisa cache log)
$app->make('config')->set('logging.default', 'stderr');
$app->make('config')->set('cache.default', 'array');
$app->make('config')->set('session.driver', 'cookie');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// 3. OTOMATIS RUN MIGRATION (Menggunakan database in-memory agar aman)
try {
    if (isset($_SERVER['VERCEL_JOB_ID']) || isset($_SERVER['NOW_REGION'])) {
        Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    }
} catch (\Exception $e) {
    // Abaikan jika migrasi gagal atau ganda
}

// 4. Tangani request halaman web
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);