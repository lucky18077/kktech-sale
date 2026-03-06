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
        'business_category_id',
        'product_category_id',
        'product_subcategory_id',
        'product_uom_id',
        'warranty_days',
        'name',
        'description',
        'img',
        'price',
        'dealer_price',
        'purchase_price',
        'hsn_code',
        'min_stock',
        'gst_tax',
        'cess_tax',
        'active'
    ];

    public function businessCategory()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function productSubcategory()
    {
        return $this->belongsTo(ProductSubcategory::class, 'product_subcategory_id');
    }

     public function productUOM()
    {
        return $this->belongsTo(ProductUOM::class, 'product_uom_id');
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
