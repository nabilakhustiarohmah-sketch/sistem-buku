<?php

use Illuminate\Foundation\Configuration\ApplicationBuilder;

return ApplicationBuilder::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware()
    ->withExceptions()
    ->create()
    ->useStoragePath('/tmp/storage');
