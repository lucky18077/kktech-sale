<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Status
 */
class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'status_name',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
