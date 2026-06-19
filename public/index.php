<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek apakah aplikasi sedang dalam mode maintenance...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Registrasi Autoloader Composer...
require __DIR__.'/../vendor/autoload.php';

// Jalankan Aplikasi Laravel...
$app = require_once __DIR__.'/../bootstrap/app.php';

$handle = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $handle->handle(
    $request = Request::capture()
)->send();

$handle->terminate($request, $response);
// Pancingan build baru ke-1