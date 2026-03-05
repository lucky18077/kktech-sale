<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaMaster;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
  public function index() {
    $areamst =  AreaMaster::where('active', 1)->get();

    return view('admin.vp', compact($areamst));
  }
}
