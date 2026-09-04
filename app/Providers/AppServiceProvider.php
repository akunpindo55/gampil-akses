<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enforce HTTPS on Vercel / Production
        if (app()->environment('production') || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) || isset($_ENV['VERCEL'])) {
            URL::forceScheme('https');
        }

        // Auto-run migrations if database tables do not exist yet (Vercel serverless cold-boot resilience)
        try {
            if (!Schema::hasTable('users') || !Schema::hasTable('settings')) {
                Artisan::call('migrate', ['--force' => true]);
                Artisan::call('db:seed', ['--force' => true]);
            }

            // Ensure image_base64 column exists in visitor_snapshots for serverless image persistence
            if (Schema::hasTable('visitor_snapshots') && !Schema::hasColumn('visitor_snapshots', 'image_base64')) {
                Schema::table('visitor_snapshots', function (Blueprint $table) {
                    $table->longText('image_base64')->nullable();
                });
            }
        } catch (\Throwable) {
            // Silently pass if database connection is pending or read-only
        }
    }
}
