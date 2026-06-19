<?php

// 1. Muat Composer Autoloader
require __DIR__.'/../vendor/autoload.php';

// Paksa Laravel memindahkan jalur penulisan cache ke folder /tmp yang writable di Vercel
$cachePath = '/tmp/bootstrap/cache';
if (!file_exists($cachePath)) {
    mkdir($cachePath, 0755, true);
}
putenv("APP_MANIFEST_CACHE_PATH={$cachePath}/packages.php");
putenv("APP_SERVICES_CACHE_PATH={$cachePath}/services.php");

// 2. Siapkan folder temporary untuk storage
if (!isset($_ENV['VAPOR_ARTIFACT_NAME'])) {
    @mkdir('/tmp/storage/logs', 0755, true);
    @mkdir('/tmp/storage/framework/views', 0755, true);
}

// 3. Muat Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// 4. Paksa jalur storage ke folder /tmp yang bisa ditulis
$app->useStoragePath('/tmp/storage');

// 5. Jalankan Aplikasi
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);