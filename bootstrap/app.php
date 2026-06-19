<?php

use Illuminate\Foundation\Application;

$app = new Application(
    dirname(__DIR__)
);

// arahkan storage ke /tmp
$app->useStoragePath('/tmp/storage');

return $app;
