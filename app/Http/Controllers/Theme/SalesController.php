<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    /**
     * Display Customers page
     */
    public function customers()
    {
        return view('theme.sales.customers');
    }

    /**
     * Display Quotations page
     */
    public function quotations()
    {
        return view('theme.sales.quotations');
    }

    /**
     * Display Sales Orders page
     */
    public function salesOrders()
    {
        return view('theme.sales.sales-orders');
    }

    /**
     * Display Invoices page
     */
    public function invoices()
    {
        return view('theme.sales.invoices');
    }

    /**
     * Display Suppliers page
     */
    public function suppliers()
    {
        return view('theme.sales.suppliers');
    }
}
