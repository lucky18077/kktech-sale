<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CoordinatorController;
use App\Http\Controllers\Admin\VPController;
use App\Http\Controllers\Admin\SalesExecutiveManagerController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\OfficeTeamController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware([\App\Http\Middleware\EnsureAdmin::class])
    ->group(function () {
        // Staff Management
        Route::get('/coordinator', [CoordinatorController::class, 'index'])->name('coordinator');
        Route::get('/v-p', [VPController::class, 'index'])->name('vp');
        Route::get('/sales-executive-manager', [SalesExecutiveManagerController::class, 'index'])->name('sales-executive-manager');
        Route::get('/designation', [DesignationController::class, 'index'])->name('designation');
        Route::get('/office-team', [OfficeTeamController::class, 'index'])->name('office-team');
    });
