<?php

// PAKSA MODUS DEBUG AKTIF AGAR ERRORNYA KELUAR
putenv('APP_DEBUG=true');
$_ENV['APP_DEBUG'] = 'true';
putenv('APP_ENV=production');

// 1. Muat Composer Autoloader terlebih dahulu
require __DIR__.'/../vendor/autoload.php';

// 2. Alihkan folder storage ke /tmp SEBELUM Laravel memuat konfigurasi apa pun
if (!isset($_ENV['VAPOR_ARTIFACT_NAME'])) {
    @mkdir('/tmp/storage/logs', 0755, true);
    @mkdir('/tmp/storage/framework/views', 0755, true);
}

// 3. Terobos bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// 4. Paksa aplikasi menggunakan folder /tmp untuk menulis log dan cache view
$app->useStoragePath('/tmp/storage');

// 5. Jalankan kernel seperti biasa
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);