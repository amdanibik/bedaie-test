<?php

/**
 * Vercel Serverless Entry Point for Laravel
 *
 * Vercel's filesystem is read-only except for /tmp,
 * so we redirect Laravel's storage and bootstrap cache to /tmp.
 */

$appPath    = dirname(__DIR__);
$storagePath   = '/tmp/storage';
$cachePath  = '/tmp/bootstrap/cache';
$dirs = [
    "$storagePath/app/public",
    "$storagePath/framework/cache/data",
    "$storagePath/framework/sessions",
    "$storagePath/framework/views",
    "$storagePath/logs",
    $cachePath,
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy providers.php to writable location (bootstrap/providers.php must be readable)
$providersSource = $appPath . '/bootstrap/providers.php';
$providersDest   = '/tmp/bootstrap/providers.php';
if (!file_exists($providersDest) && file_exists($providersSource)) {
    copy($providersSource, $providersDest);
}

$_ENV['APP_STORAGE']        = $storagePath;
$_ENV['APP_BOOTSTRAP_PATH'] = '/tmp/bootstrap';

// Vercel filesystem is read-only; override drivers that need local file writes
$_ENV['SESSION_DRIVER'] = $_ENV['SESSION_DRIVER'] ?? 'cookie';
$_ENV['CACHE_STORE']    = $_ENV['CACHE_STORE'] ?? 'array';
$_ENV['LOG_CHANNEL']    = $_ENV['LOG_CHANNEL'] ?? 'stderr';

$publicPath = $appPath . '/public';
chdir($publicPath);
require $publicPath . '/index.php';
