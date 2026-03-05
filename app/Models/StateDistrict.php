<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StateDistrict
 */
class StateDistrict extends Model
{
    use HasFactory;

    protected $table = 'state_district';

    protected $fillable = [
        'state',
        'district',
    ];
}
