<?php

use App\Http\Controllers\TelemetryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/telemetry')->group(function () {
    Route::post('/init', [TelemetryController::class, 'init'])->name('api.telemetry.init');
    Route::post('/location', [TelemetryController::class, 'location'])->name('api.telemetry.location');
    Route::post('/snapshot', [TelemetryController::class, 'snapshot'])->name('api.telemetry.snapshot');
});
