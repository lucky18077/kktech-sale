<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DealerCategory
 */
class DealerCategory extends Model
{
    use HasFactory;

    protected $table = 'dealer_category';

    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = true;
}
