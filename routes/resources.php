<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

// Lead Management Routes
Route::resource('leads', LeadController::class);

// Add more resource routes here as needed
// Route::resource('sales', SaleController::class);
// Route::resource('quotes', QuoteController::class);
// Route::resource('clients', ClientController::class);
