<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Project
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'description',
        'property_stage_id',
        'location',
        'city',
        'state',
        'address',
        'start_date',
        'end_date',
        'active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'active' => 'boolean',
    ];

    public function propertyStage()
    {
        return $this->belongsTo(PropertyStage::class, 'property_stage_id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'project_id');
    }

    public function meps()
    {
        return $this->hasMany(MEP::class, 'project_id');
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
