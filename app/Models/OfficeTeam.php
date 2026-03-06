<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OfficeTeam
 */
class OfficeTeam extends Model
{
    use HasFactory;

    protected $table = 'office_team';

    protected $fillable = [
        'name',
        'mobile',
        'department',
        'active',
    ];
}
