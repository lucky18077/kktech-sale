<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CoordinatorController extends Controller
{
    public function index()
    {
        // list users with type Sales coordinator
        $coordinators = User::where('user_type', 'Sales coordinator')->get();
        return view('admin.coordinator.index', compact('coordinators'));
    }
}
