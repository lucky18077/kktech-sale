<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }
}
