<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class VPController extends Controller
{
    public function index()
    {
        $vps = User::where('user_type', 'vice President')->get();
        return view('admin.vp.index', compact('vps'));
    }
}
