<?php

// 1. Jalankan core Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// 2. OTOMATIS RUN MIGRATION (Membuat tabel books dll secara instan di memori Vercel)
try {
    if (isset($_SERVER['VERCEL_JOB_ID']) || isset($_SERVER['NOW_REGION'])) {
        Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    }
} catch (\Exception $e) {
    // Abaikan jika terjadi kendala migrasi ganda
}

// 3. Tangani request halaman web
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);