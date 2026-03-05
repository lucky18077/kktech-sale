<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Designation
 */
class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'desig_name',
        'dept_id',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'desig_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }
}
