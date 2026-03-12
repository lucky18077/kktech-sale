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
        'qty',
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
