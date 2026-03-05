<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file contains the application's web routes organized by feature
|
*/

// Auth Routes
require __DIR__ . '/auth.php';

// Protected Routes (Require authentication via custom SuperAdmin middleware)
// the original `auth` middleware is no longer used; we rely on our
// custom token/session based logic defined in App\Http\Middleware\SuperAdmin.
// You can either reference the class directly here or register an alias in
// the kernel/bootstrapping code.  For simplicity we import the class and
// pass it to the middleware array.
use App\Http\Middleware\SuperAdmin;

// all routes that were previously behind `auth` now use the SuperAdmin
// middleware which checks the session token, user type, builds the
// hierarchy of child users, and shares permissions with views.
Route::middleware([SuperAdmin::class])->group(function () {
    // Dashboard Routes
    require __DIR__ . '/dashboards.php';
    
    // Resource Routes (Lead, Sale, Quote, etc.)
    require __DIR__ . '/resources.php';
    
    // Admin Routes
    require __DIR__ . '/admin.php';
});

