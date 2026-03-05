<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Category
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function dealerCategories()
    {
        return $this->hasMany(DealerCategory::class, 'category_id');
    }

    public function discounts()
    {
        return $this->hasMany(CategoryDiscount::class, 'category_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }
}
