<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    /**
     * Display Products page
     */
    public function products()
    {
        return view('theme.inventory.products');
    }

    /**
     * Display Categories page
     */
    public function categories()
    {
        return view('theme.inventory.categories');
    }

    /**
     * Display Stock Management page
     */
    public function stock()
    {
        return view('theme.inventory.stock');
    }
}
