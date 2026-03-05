<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Department
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'dept_name',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'dept_id');
    }

    public function designations()
    {
        return $this->hasMany(Designation::class, 'dept_id');
    }

    public function officeTeams()
    {
        return $this->hasMany(OfficeTeam::class, 'dept_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }
}
