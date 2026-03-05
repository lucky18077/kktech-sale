<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Client
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'email',
        'dob',
        'address',
        'state',
        'city',
        'company_name',
        'remarks',
        'active',
    ];

    protected $casts = [
        'dob' => 'date',
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
