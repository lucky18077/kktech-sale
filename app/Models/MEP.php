<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\MEP
 */
class MEP extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mep';

    protected $fillable = [
        'project_id',
        'mep_type',
        'category',
        'sub_category',
        'description',
        'status',
        'planned_date',
        'actual_date',
        'assigned_to',
        'notes',
    ];

    protected $casts = [
        'planned_date' => 'date',
        'actual_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
