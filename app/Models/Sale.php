<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Sale
 */
class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sale_no',
        'lead_id',
        'quote_id',
        'user_id',
        'dealer_id',
        'subtotal',
        'discount_percent',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'paid_amount',
        'payment_status',
        'delivery_status',
        'sale_date',
        'delivery_date',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_percent' => 'integer',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'sale_date' => 'date',
        'delivery_date' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'quote_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }

    public function orderReturns()
    {
        return $this->hasMany(OrderReturnMaster::class, 'sale_id');
    }

    public function scopeByStatus(Builder $query, $status)
    {
        return $query->where('payment_status', $status);
    }

    public function scopeByUser(Builder $query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByDateRange(Builder $query, $startDate, $endDate)
    {
        return $query->whereBetween('sale_date', [$startDate, $endDate]);
    }
}
