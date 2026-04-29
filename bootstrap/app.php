<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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

// Support custom storage/bootstrap paths for serverless environments (e.g. Vercel)
if (!empty($_ENV['APP_STORAGE'])) {
    $app->useStoragePath($_ENV['APP_STORAGE']);
}

if (!empty($_ENV['APP_BOOTSTRAP_PATH'])) {
    $app->useBootstrapPath($_ENV['APP_BOOTSTRAP_PATH']);
}

return $app;
