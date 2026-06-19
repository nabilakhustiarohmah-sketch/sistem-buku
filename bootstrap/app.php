<?php

use Illuminate\Foundation\Application;

$app = new Application(
    dirname(__DIR__)
);

// arahkan storage ke /tmp
$app->useStoragePath('/tmp/storage');
if (!is_dir('/tmp/bootstrap/cache')) {
    mkdir('/tmp/bootstrap/cache', 0755, true);
}

return $app;
