<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DealerPrice
 */
class DealerPrice extends Model
{
    use HasFactory;

    protected $table = 'dealer_price';

    protected $fillable = [
        'dealer_id',
        'product_id',
        'price',
        'discount_percent',
        'discount_amount',
        'final_price',
        'effective_from',
        'effective_till',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percent' => 'integer',
        'discount_amount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'effective_from' => 'date',
        'effective_till' => 'date',
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
