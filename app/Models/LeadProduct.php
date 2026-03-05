<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LeadProduct
 */
class LeadProduct extends Model
{
    use HasFactory;

    protected $table = 'lead_product';

    protected $fillable = [
        'lead_id',
        'product_id',
        'quantity',
        'interested_price',
        'remarks',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'interested_price' => 'decimal:2',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
