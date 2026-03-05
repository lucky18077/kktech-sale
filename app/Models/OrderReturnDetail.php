<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderReturnDetail
 */
class OrderReturnDetail extends Model
{
    use HasFactory;

    protected $table = 'order_return_det';

    protected $fillable = [
        'return_id',
        'product_id',
        'quantity',
        'unit_price',
        'line_total',
        'remarks',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'line_total' => 'decimal:2',
    ];

    public function returnMaster()
    {
        return $this->belongsTo(OrderReturnMaster::class, 'return_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
