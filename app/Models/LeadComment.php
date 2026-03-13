<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\LeadComment
 */
class LeadComment extends Model
{
    use HasFactory;

    protected $table = 'lead_comments';

    protected $fillable = [
        'lead_id',
        'user_id',
        'comment',
    ];

    protected $casts = [
        'is_internal' => 'boolean',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeInternal(Builder $query)
    {
        return $query->where('is_internal', 1);
    }

    public function scopePublic(Builder $query)
    {
        return $query->where('is_internal', 0);
    }
}
