<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Dealer
 */
class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'email',
        'dob',
        'address',
        'state',
        'city',
        'company_name',
        'remarks',
        'gst_number',
        'active',
    ];

    protected $casts = [
        'dob' => 'date',
        'active' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'dealer_category', 'dealer_id', 'category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'dealer_product', 'dealer_id', 'product_id')
            ->withPivot('stock_qty')
            ->withTimestamps();
    }

    public function dealerProducts()
    {
        return $this->hasMany(DealerProduct::class, 'dealer_id');
    }

    public function dealerPrices()
    {
        return $this->hasMany(DealerPrice::class, 'dealer_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'dealer_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }

    public function scopeByLocation(Builder $query, $state, $city = null)
    {
        $query->where('state', $state);
        
        if ($city) {
            $query->where('city', $city);
        }

        return $query;
    }
}
