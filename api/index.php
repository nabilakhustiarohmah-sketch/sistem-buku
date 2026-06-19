<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

try {
    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    echo "<h2>Error:</h2>";
    echo "<pre>";
    echo $e->getMessage();
    echo "\n\nFile: ".$e->getFile();
    echo "\nLine: ".$e->getLine();
    echo "</pre>";
}