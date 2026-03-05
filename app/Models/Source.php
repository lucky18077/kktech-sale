<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Source
 */
class Source extends Model
{
    use HasFactory;

    protected $table = 'sources';

    protected $fillable = [
        'source_name',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'source_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }
}
