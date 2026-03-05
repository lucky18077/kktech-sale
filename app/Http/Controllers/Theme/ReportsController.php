<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    /**
     * Display Sales Report page
     */
    public function salesReport()
    {
        return view('theme.reports.sales-report');
    }

    /**
     * Display Analytics page
     */
    public function analytics()
    {
        return view('theme.reports.analytics');
    }
}
