<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuoteDetail
 */
class QuoteDetail extends Model
{
    use HasFactory;

    protected $table = 'quotes_det';

    protected $fillable = [
        'quote_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount_percent',
        'discount_amount',
        'line_total',
        'remarks',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'discount_percent' => 'integer',
        'discount_amount' => 'decimal:2',
        'line_total' => 'decimal:2',
    ];

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'quote_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
