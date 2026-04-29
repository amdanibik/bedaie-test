<?php

/**
 * Vercel Serverless Entry Point for Laravel
 *
 * Vercel's filesystem is read-only except for /tmp,
 * so we redirect Laravel's storage to /tmp.
 */

$storagePath = '/tmp/storage';
$dirs = [
    "$storagePath/app/public",
    "$storagePath/framework/cache/data",
    "$storagePath/framework/sessions",
    "$storagePath/framework/views",
    "$storagePath/logs",
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

$_ENV['APP_STORAGE'] = $storagePath;

$publicPath = __DIR__ . '/../public';
chdir($publicPath);
require $publicPath . '/index.php';
