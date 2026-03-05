<?php

namespace App\Traits;

trait Filterable
{
    /**
     * Filter records by multiple criteria
     */
    public function scopeFilter($query, $filters)
    {
        return collect($filters)
            ->filter(function ($value) {
                return $value !== null && $value !== '';
            })
            ->reduce(function ($query, $value, $key) {
                return $query->where($key, 'like', "%{$value}%");
            }, $query);
    }

    /**
     * Filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get active records only
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Filter by date range
     */
    public function scopeDateBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
