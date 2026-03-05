<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BusinessCategory
 */
class BusinessCategory extends Model
{
    use HasFactory;

    protected $table = 'business_category';

    protected $fillable = [
        'name',
        'description',
        'active',
    ];
}
