<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Unified dashboard route — uses auth middleware from web.php
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Admin, Coordinator, VP named routes (preserve existing controllers/views)
Route::get('/coordinator/dashboard', [\App\Http\Controllers\Coordinator\DashboardController::class, 'index'])->name('coordinator.dashboard');
Route::get('/vp/dashboard', function () {
    return view('vp.dashboard');
})->name('vp.dashboard');
