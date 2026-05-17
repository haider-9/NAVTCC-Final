<?php
/**
 * Laravel entry point for Vercel serverless functions.
 */

// Set the base path for Laravel
define('LARAVEL_BASE_PATH', dirname(__DIR__));

require LARAVEL_BASE_PATH . '/vendor/autoload.php';

$app = require_once LARAVEL_BASE_PATH . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
