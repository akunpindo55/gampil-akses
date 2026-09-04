<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            if (!Schema::hasTable('settings')) {
                return $default;
            }
            $setting = static::where('key', $key)->first();
            if (!$setting) {
                return $default;
            }
            return $setting->value ?? '';
        } catch (\Throwable) {
            return $default;
        }
    }

    public static function set(string $key, mixed $value, ?string $description = null): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'description' => $description ?? (static::where('key', $key)->value('description') ?? null)
            ]
        );
    }
}
