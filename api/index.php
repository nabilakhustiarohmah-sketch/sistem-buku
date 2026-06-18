<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

try {
    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    echo "<pre>";
    echo $e->getMessage();
    echo "\n\n";
    echo $e->getFile();
    echo " : ";
    echo $e->getLine();
    echo "</pre>";
}