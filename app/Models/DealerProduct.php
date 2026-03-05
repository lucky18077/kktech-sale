<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DealerProduct
 */
class DealerProduct extends Model
{
    use HasFactory;

    protected $table = 'dealer_product';

    protected $fillable = [
        'dealer_id',
        'product_id',
        'stock_qty',
    ];

    protected $casts = [
        'stock_qty' => 'integer',
    ];

    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
