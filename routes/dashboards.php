<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\MasterController;

// Unified dashboard route — uses auth middleware from web.php
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/vp', [StaffController::class, 'showVps'])->name('vp');
Route::post('/vp-save', [StaffController::class, 'addVp'])->name('vp-save');
Route::get('/coordinator', [StaffController::class, 'showCoordinators'])->name('coordinator');
Route::post('/coordinator-save', [StaffController::class, 'addCoordinator'])->name('coordinator-save');



// Master Controller
Route::get('/business-category', [MasterController::class, 'businessCategory'])->name('business-category');
Route::post('/business-category-save', [MasterController::class, 'saveBusinessCategory'])->name('business-category-save');

Route::get('/department', [MasterController::class, 'department'])->name('department');
Route::post('/department-save', [MasterController::class, 'saveDepartment'])->name('department-save');

Route::get('/property-stage', [MasterController::class, 'propertyStage'])->name('property-stage');
Route::post('/property-stage-save', [MasterController::class, 'savePropertyStage'])->name('property-stage-save');

Route::get('/source', [MasterController::class, 'source'])->name('source');
Route::post('/source-save', [MasterController::class, 'saveSource'])->name('source-save');

// Admin, Coordinator, VP named routes (preserve existing controllers/views)
Route::get('/coordinator/dashboard', [\App\Http\Controllers\Coordinator\DashboardController::class, 'index'])->name('coordinator.dashboard');
Route::get('/vp/dashboard', function () {
    return view('vp.dashboard');
})->name('vp.dashboard');
