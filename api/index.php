<?php

// 1. Jalankan core autoload Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 2. Paksa konfigurasi logging & session ke memori agar anti-read-only
config(['logging.default' => 'stderr']);
config(['cache.default' => 'array']);
config(['session.driver' => 'cookie']);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// 3. Tangani request halaman web
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);