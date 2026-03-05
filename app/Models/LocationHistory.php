<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\LocationHistory
 */
class LocationHistory extends Model
{
    use HasFactory;

    protected $table = 'location_history';

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'location_name',
        'address',
        'city',
        'state',
        'accuracy',
        'device_info',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'accuracy' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByUser(Builder $query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecent(Builder $query)
    {
        return $query->orderByDesc('created_at');
    }
}
