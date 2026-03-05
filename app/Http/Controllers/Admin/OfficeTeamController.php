<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeTeam;

class OfficeTeamController extends Controller
{
    public function index()
    {
        $teams = OfficeTeam::with('department')->get();
        return view('admin.office-team.index', compact('teams'));
    }
}
