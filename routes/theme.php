<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Theme\InventoryController;
use App\Http\Controllers\Theme\SalesController;
use App\Http\Controllers\Theme\ReportsController;
use App\Http\Controllers\Theme\AdminController;

/**
 * Theme Pages Route Group
 * Routes for all theme pages with proper role-based access
 */

Route::middleware([\App\Http\Middleware\SuperAdmin::class])->prefix('theme')->group(function () {
    
    // ===== INVENTORY ROUTES =====
    Route::prefix('inventory')->name('theme.inventory.')->group(function () {
        Route::get('products', [InventoryController::class, 'products'])->name('products');
        Route::get('categories', [InventoryController::class, 'categories'])->name('categories');
        Route::get('stock', [InventoryController::class, 'stock'])->name('stock');
    });

    // ===== SALES ROUTES =====
    Route::prefix('sales')->name('theme.sales.')->group(function () {
        Route::get('customers', [SalesController::class, 'customers'])->name('customers');
        Route::get('quotations', [SalesController::class, 'quotations'])->name('quotations');
        Route::get('sales-orders', [SalesController::class, 'salesOrders'])->name('sales-orders');
        Route::get('invoices', [SalesController::class, 'invoices'])->name('invoices');
        Route::get('suppliers', [SalesController::class, 'suppliers'])->name('suppliers');
    });

    // ===== REPORTS ROUTES =====
    Route::prefix('reports')->name('theme.reports.')->group(function () {
        Route::get('sales-report', [ReportsController::class, 'salesReport'])->name('sales-report');
        Route::get('analytics', [ReportsController::class, 'analytics'])->name('analytics');
    });

    // ===== ADMIN ROUTES =====
    Route::prefix('admin')->middleware(['admin'])->name('theme.admin.')->group(function () {
        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::get('roles-permissions', [AdminController::class, 'rolesPermissions'])->name('roles-permissions');
        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
        Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    });
});
