<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Sale;
use App\Models\Quote;
use App\Models\Client;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Get dashboard metrics for coordinator
     */
    public function getMetrics()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // helper for safely counting when table might not exist
        $safeCount = function ($model, $column = '*') {
            try {
                return $model::count();
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        };

        $safeWhereCount = function ($model, $callback) {
            try {
                $query = $model::query();
                $callback($query);
                return $query->count();
            } catch (\Illuminate\Database\QueryException $e) {
                return 0;
            }
        };

        return [
            'totalLeads' => $safeCount(Lead::class),
            'leadsThisMonth' => $safeWhereCount(Lead::class, fn($q) =>
                $q->whereYear('created_at', $currentYear)
                  ->whereMonth('created_at', $currentMonth)
            ),

            'activeQuotes' => $safeWhereCount(Quote::class, fn($q) =>
                $q->whereIn('status', ['pending', 'submitted'])
            ),

            'totalSales' => $safeCount(Sale::class),
            'salesThisMonth' => $safeWhereCount(Sale::class, fn($q) =>
                $q->whereYear('created_at', $currentYear)
                  ->whereMonth('created_at', $currentMonth)
            ),

            'totalClients' => $safeCount(Client::class),

            'conversionRate' => $this->calculateConversionRate(),

            'avgDealValue' => $safeWhereCount(Sale::class, fn($q) => null) ? Sale::avg('amount') ?? 0 : 0,

            'followUpsDue' => $safeWhereCount(Quote::class, fn($q) =>
                $q->where('status', 'pending')
                  ->where('created_at', '<', Carbon::now()->subDays(7))
            ),

            'wonDeals' => $safeCount(Sale::class),

            'recentLeads' => function_exists('\App\Models\Lead') ? Lead::orderBy('created_at', 'desc')->limit(5)->get() : collect(),

            'recentSales' => function_exists('\App\Models\Sale') ? Sale::select('id', 'client_name', 'product', 'amount', 'created_at')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get() : collect(),
        ];
    }

    /**
     * Calculate conversion rate
     */
    private function calculateConversionRate()
    {
        $totalLeads = Lead::count();
        $wonDeals = Sale::count();

        return $totalLeads > 0 ? round(($wonDeals / $totalLeads) * 100, 2) : 0;
    }

    /**
     * Get top performing months (sales)
     */
    public function getTopSalesMonths()
    {
        return Sale::selectRaw('DATE_TRUNC(\'month\', created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderByDesc('total')
            ->limit(12)
            ->get();
    }

    /**
     * Get sales by category
     */
    public function getSalesByCategory()
    {
        return Sale::selectRaw('product, COUNT(*) as total, SUM(amount) as revenue')
            ->groupBy('product')
            ->orderByDesc('revenue')
            ->limit(10)
            ->get();
    }
}
