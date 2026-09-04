<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeoIpService
{
    public function lookup(string $ip): array
    {
        // Handle local IP
        if ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.') || str_starts_with($ip, '172.16.')) {
            return [
                'status' => 'success',
                'continent' => 'Local Network',
                'continentCode' => 'LOC',
                'country' => 'Localhost',
                'countryCode' => 'LOC',
                'regionName' => 'Local Area',
                'city' => 'Localhost',
                'zip' => '00000',
                'isp' => 'Internal / Loopback',
                'org' => 'Private Network',
                'timezone' => date_default_timezone_get(),
                'lat' => 0.0,
                'lon' => 0.0,
                'query' => $ip,
                'reverse' => 'localhost',
            ];
        }

        try {
            $response = Http::timeout(4)->get("http://ip-api.com/json/{$ip}?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query");

            if ($response->successful()) {
                $data = $response->json();
                if (($data['status'] ?? '') === 'success') {
                    return $data;
                }
            }
        } catch (\Throwable $e) {
            Log::warning("GeoIpService lookup failed for IP {$ip}: " . $e->getMessage());
        }

        return [
            'status' => 'fail',
            'query' => $ip,
            'isp' => 'Unknown',
            'country' => 'Unknown',
            'city' => 'Unknown',
        ];
    }
}
