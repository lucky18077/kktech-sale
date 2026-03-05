<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Architect
 */
class Architect extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'dob',
        'doa',
        'address',
        'state',
        'city',
        'company',
        'remarks',
        'active',
    ];

    protected $casts = [
        'dob' => 'date',
        'doa' => 'date',
        'active' => 'boolean',
    ];

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
