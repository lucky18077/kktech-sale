<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class SalesExecutiveManagerController extends Controller
{
    public function index()
    {
        // show both sales managers and sales executives
        $users = User::whereIn('user_type', ['Sales manager', 'Sales executive'])->get();
        return view('admin.sales_executive_manager.index', compact('users'));
    }
}
