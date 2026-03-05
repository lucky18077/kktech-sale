<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StaffController;


// Unified dashboard route — uses auth middleware from web.php
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/vp', [StaffController::class, 'index'])->name('vp');

// Admin, Coordinator, VP named routes (preserve existing controllers/views)
Route::get('/coordinator/dashboard', [\App\Http\Controllers\Coordinator\DashboardController::class, 'index'])->name('coordinator.dashboard');
Route::get('/vp/dashboard', function () {
    return view('vp.dashboard');
})->name('vp.dashboard');
