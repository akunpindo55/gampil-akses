<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('visitor')->after('email');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 64)->index();
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('platform')->nullable();
            $table->string('browser_name')->nullable();
            $table->string('browser_language')->nullable();
            $table->string('ram')->nullable();
            $table->string('cpu_cores')->nullable();
            $table->string('screen_resolution')->nullable();
            $table->text('referrer')->nullable();
            
            // IP Recon Info
            $table->string('continent')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('region_name')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('isp')->nullable();
            $table->string('org')->nullable();
            $table->string('timezone')->nullable();
            $table->decimal('ip_lat', 10, 7)->nullable();
            $table->decimal('ip_lon', 10, 7)->nullable();
            
            // GPS Location
            $table->decimal('gps_lat', 10, 7)->nullable();
            $table->decimal('gps_lon', 10, 7)->nullable();
            $table->decimal('gps_accuracy', 8, 2)->nullable();
            $table->text('gps_error')->nullable();
            $table->timestamp('gps_captured_at')->nullable();

            $table->timestamps();
        });

        Schema::create('visitor_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_log_id')->nullable()->constrained('visitor_logs')->onDelete('cascade');
            $table->string('uuid', 64)->index();
            $table->string('file_path');
            $table->longText('image_base64')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_snapshots');
        Schema::dropIfExists('visitor_logs');
        Schema::dropIfExists('settings');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
