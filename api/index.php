<?php

// Menghubungkan langsung ke core aplikasi tanpa lewat public/index.php luar
require __DIR__ . '/../vendor/autoload.php';
$app = require_with_result(__DIR__ . '/../bootstrap/app.php');

function require_with_result($filename) {
    return require $filename;
}

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);