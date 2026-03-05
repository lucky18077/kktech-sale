<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display Users page
     */
    public function users()
    {
        return view('theme.admin.users');
    }

    /**
     * Display Roles & Permissions page
     */
    public function rolesPermissions()
    {
        return view('theme.admin.roles-permissions');
    }

    /**
     * Display Settings page
     */
    public function settings()
    {
        return view('theme.admin.settings');
    }

    /**
     * Display Profile page
     */
    public function profile()
    {
        return view('theme.admin.profile');
    }
}
