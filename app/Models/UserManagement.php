<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserManagement
 */
class UserManagement extends Model
{
    use HasFactory;

    protected $table = 'user_mgmt';

    protected $fillable = [
        'user_id',
        'role',
        'can_add',
        'can_edit',
        'can_delete',
        'can_view',
        'can_export',
    ];

    protected $casts = [
        'can_add' => 'boolean',
        'can_edit' => 'boolean',
        'can_delete' => 'boolean',
        'can_view' => 'boolean',
        'can_export' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
