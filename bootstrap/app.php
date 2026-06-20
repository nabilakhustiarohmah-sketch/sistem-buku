<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Buat instance $app terlebih dahulu
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// 2. Sekarang $app sudah ada, baru kita paksa gunakan folder /tmp di Vercel
if (isset($_SERVER['VERCEL_JOB_ID']) || isset($_SERVER['NOW_REGION'])) {
    $targetPath = '/tmp/storage';
    if (!file_exists($targetPath)) {
        @mkdir($targetPath, 0755, true);
        @mkdir($targetPath . '/logs', 0755, true);
        @mkdir($targetPath . '/framework/views', 0755, true);
    }
    
    // Ini dijamin aman dan tidak akan merah lagi
    $app->useStoragePath($targetPath);
}

// 3. Kembalikan objek $app yang sudah dimodifikasi
return $app;