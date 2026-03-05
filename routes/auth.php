<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public auth routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
