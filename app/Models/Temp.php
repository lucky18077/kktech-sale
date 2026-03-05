<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Temp
 */
class Temp extends Model
{
    use HasFactory;

    protected $table = 'temp';

    protected $fillable = [
        'temp_key',
        'temp_value',
    ];
}
