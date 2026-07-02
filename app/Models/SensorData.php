<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use DateTimeInterface;

class SensorData extends Model
{
    /**
     * Prepare a date for array / JSON serialization.
     * Converts all timestamps to Asia/Makassar (WITA/GMT+8) timezone.
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->setTimezone(new \DateTimeZone('Asia/Makassar'))->format('Y-m-d H:i:s');
    }
    protected $fillable = [
        'user_id',
        'temperature',
        'ph',
        'ntu',
        'fuzzy',
        'relay_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
