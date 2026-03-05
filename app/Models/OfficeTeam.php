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
        'user_id',
        'team_name',
        'dept_id',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
