<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryDiscount
 */
class CategoryDiscount extends Model
{
    use HasFactory;

    protected $table = 'category_discount';

    protected $fillable = [
        'category_name',
        'category_id',
        'dealer_category_id',
        'discount'
    ];
}
