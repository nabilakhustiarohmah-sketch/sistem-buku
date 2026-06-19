<?php

// Trik mutlak: Alihkan folder storage ke /tmp SEBELUM Laravel memuat konfigurasi apa pun
if (!isset($_ENV['VAPOR_ARTIFACT_NAME'])) {
    // Buat folder logs di /tmp agar tidak error saat dibaca oleh stream handler
    @mkdir('/tmp/storage/logs', 0755, true);
    @mkdir('/tmp/storage/framework/views', 0755, true);
}

// Terobos bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Paksa aplikasi menggunakan folder /tmp untuk menulis log dan cache view
$app->useStoragePath('/tmp/storage');

// Jalankan kernel seperti biasa
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);