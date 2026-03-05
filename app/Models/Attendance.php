<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Attendance
 */
class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'attendance_date',
        'check_in_time',
        'check_out_time',
        'hours_worked',
        'status',
        'remarks',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'hours_worked' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByDate(Builder $query, $date)
    {
        return $query->where('attendance_date', $date);
    }

    public function scopeByUser(Builder $query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByDateRange(Builder $query, $startDate, $endDate)
    {
        return $query->whereBetween('attendance_date', [$startDate, $endDate]);
    }
}
