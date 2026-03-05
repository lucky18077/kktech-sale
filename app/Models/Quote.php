<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Quote
 */
class Quote extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'quotes_mst';

    protected $fillable = [
        'quote_no',
        'lead_id',
        'user_id',
        'subtotal',
        'discount_percent',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'status',
        'quote_date',
        'valid_till',
        'notes',
        'terms_and_conditions',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_percent' => 'integer',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'quote_date' => 'date',
        'valid_till' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(QuoteDetail::class, 'quote_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'quote_id');
    }

    public function scopeByStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeValid(Builder $query)
    {
        return $query->where('valid_till', '>=', now()->date);
    }

    public function scopeByUser(Builder $query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
