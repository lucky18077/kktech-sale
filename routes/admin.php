<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SalesExecutiveManagerController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\OfficeTeamController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware([\App\Http\Middleware\EnsureAdmin::class])
    ->group(function () {
        // Admin specific routes
        Route::get('/sales-executive-manager', [SalesExecutiveManagerController::class, 'index'])->name('sales-executive-manager');
        Route::get('/designation', [DesignationController::class, 'index'])->name('designation');
        Route::get('/office-team', [OfficeTeamController::class, 'index'])->name('office-team');
    });
