<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Product
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_code',
        'product_name',
        'category_id',
        'subcategory_id',
        'price',
        'stock_qty',
        'description',
        'sku',
        'cost_price',
        'active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock_qty' => 'integer',
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function leadProducts()
    {
        return $this->hasMany(LeadProduct::class, 'product_id');
    }

    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'lead_product', 'product_id', 'lead_id')
            ->withPivot('quantity', 'interested_price', 'remarks')
            ->withTimestamps();
    }

    public function quoteDetails()
    {
        return $this->hasMany(QuoteDetail::class, 'product_id');
    }

    public function dealerProducts()
    {
        return $this->hasMany(DealerProduct::class, 'product_id');
    }

    public function dealerPrices()
    {
        return $this->hasMany(DealerPrice::class, 'product_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }

    public function scopeInStock(Builder $query)
    {
        return $query->where('stock_qty', '>', 0);
    }

    public function scopeByCategory(Builder $query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
