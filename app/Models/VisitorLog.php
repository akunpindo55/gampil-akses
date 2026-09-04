<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisitorLog extends Model
{
    protected $fillable = [
        'uuid',
        'ip',
        'user_agent',
        'platform',
        'browser_name',
        'browser_language',
        'ram',
        'cpu_cores',
        'screen_resolution',
        'referrer',
        'continent',
        'country',
        'country_code',
        'region_name',
        'city',
        'zip',
        'isp',
        'org',
        'timezone',
        'ip_lat',
        'ip_lon',
        'gps_lat',
        'gps_lon',
        'gps_accuracy',
        'gps_error',
        'gps_captured_at',
    ];

    protected $casts = [
        'gps_lat' => 'float',
        'gps_lon' => 'float',
        'ip_lat' => 'float',
        'ip_lon' => 'float',
        'gps_accuracy' => 'float',
        'gps_captured_at' => 'datetime',
    ];

    public function snapshots(): HasMany
    {
        return $this->hasMany(VisitorSnapshot::class, 'visitor_log_id');
    }
}
