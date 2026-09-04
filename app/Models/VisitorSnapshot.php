<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class VisitorSnapshot extends Model
{
    protected $fillable = [
        'visitor_log_id',
        'uuid',
        'file_path',
        'image_base64',
    ];

    public function visitorLog(): BelongsTo
    {
        return $this->belongsTo(VisitorLog::class, 'visitor_log_id');
    }

    public function getUrlAttribute(): string
    {
        if (!empty($this->image_base64)) {
            return 'data:image/jpeg;base64,' . $this->image_base64;
        }

        return asset('storage/' . $this->file_path);
    }
}
