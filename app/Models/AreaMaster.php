<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\AreaMaster
 */
class AreaMaster extends Model
{
    use HasFactory;

    protected $table = 'area_mst';

    protected $fillable = [
        'name',
        'city',
        'state',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'area_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }

    public function scopeByLocation(Builder $query, $state, $city = null)
    {
        $query->where('state', $state);
        
        if ($city) {
            $query->where('city', $city);
        }

        return $query;
    }
}
