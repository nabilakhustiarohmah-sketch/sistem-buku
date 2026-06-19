<?php

// 1. Panggil autoloader bawaan Composer
require __DIR__ . '/../vendor/autoload.php';

// 2. Paksa Laravel memindahkan jalur penulisan cache ke folder /tmp yang writable di Vercel
$cachePath = '/tmp/bootstrap/cache';
if (!file_exists($cachePath)) {
    mkdir($cachePath, 0755, true);
}
putenv("APP_MANIFEST_CACHE_PATH={$cachePath}/packages.php");
putenv("APP_SERVICES_CACHE_PATH={$cachePath}/services.php");

// 3. Jalankan aplikasi Laravel seperti biasa
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);