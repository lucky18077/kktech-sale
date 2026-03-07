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
       'coordinator_id',
       'business_category_id',
       'reporting_manager_id'
    ];
}
