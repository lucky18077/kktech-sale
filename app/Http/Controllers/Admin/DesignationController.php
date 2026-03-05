<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        return view('admin.designation.index', compact('designations'));
    }
}
