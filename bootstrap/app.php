<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Amankan Vercel: Pindahkan folder cache ke /tmp agar tidak Read-Only
if (isset($_SERVER['VERCEL_JOB_ID']) || isset($_SERVER['NOW_REGION'])) {
    $cachePath = '/tmp/bootstrap/cache';
    if (!file_exists($cachePath)) {
        mkdir($cachePath, 0755, true);
    }
    putenv("APP_MANIFEST_CACHE_PATH={$cachePath}/packages.php");
    putenv("APP_SERVICES_CACHE_PATH={$cachePath}/services.php");
}

return Application::configure(basePath: dirname(__DIR__))
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