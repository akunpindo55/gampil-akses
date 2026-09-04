<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'api/*',
            'v1/*',
            'telemetry/*',
            'location_update',
            'image',
            'get_target',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->is('v1/*') || $request->is('telemetry/*') || $request->expectsJson(),
        );
    })->create();

// Handle Vercel serverless read-only filesystem by redirecting storage to /tmp
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL') || getenv('APP_STORAGE_PATH')) {
    $storagePath = getenv('APP_STORAGE_PATH') ?: ($_ENV['APP_STORAGE_PATH'] ?? '/tmp/storage');
    $app->useStoragePath($storagePath);
}

return $app;
