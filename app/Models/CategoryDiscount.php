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
        'category_id',
        'discount_percent',
        'discount_amount',
        'effective_from',
        'effective_till',
        'active',
    ];

    protected $casts = [
        'discount_percent' => 'integer',
        'discount_amount' => 'decimal:2',
        'effective_from' => 'date',
        'effective_till' => 'date',
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
