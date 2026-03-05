<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\OrderReturnMaster
 */
class OrderReturnMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_return_mst';

    protected $fillable = [
        'return_no',
        'sale_id',
        'user_id',
        'reason',
        'description',
        'status',
        'refund_amount',
        'return_date',
        'approval_date',
        'completion_date',
    ];

    protected $casts = [
        'refund_amount' => 'decimal:2',
        'return_date' => 'date',
        'approval_date' => 'date',
        'completion_date' => 'date',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderReturnDetail::class, 'return_id');
    }

    public function scopeByStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }
}
