<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PartnerManagementController;

/* Dashboard routes */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/* Staff routes */
Route::get('/vp', [StaffController::class, 'showVps'])->name('vp');
Route::post('/vp-save', [StaffController::class, 'addVp'])->name('vp-save');
Route::get('/coordinator', [StaffController::class, 'showCoordinators'])->name('coordinator');
Route::post('/coordinator-save', [StaffController::class, 'addCoordinator'])->name('coordinator-save');
Route::get('/saleManager', [StaffController::class, 'showSalesManager'])->name('saleManager');
Route::post('/saleManager-save', [StaffController::class, 'addSalesManager'])->name('saleManager-save');
Route::get('/view-sales-manager-details/{id}', [StaffController::class, 'viewSalesManagerDetails'])->name('view-sales-manager-details');
Route::get('/view-sales-executive-details/{id}', [StaffController::class, 'viewSalesExecutiveDetails'])->name('view-sales-executive-details');
Route::post('/getCoordinatorData', [StaffController::class, 'getCoordinatorData'])->name('getCoordinatorData');
Route::post('/getReportingManagers', [StaffController::class, 'getReportingManagers'])->name('getReportingManagers');
Route::get('/vp/coordinators/{vpId}', [StaffController::class, 'getVpCoordinators'])->name('vp.coordinators');
Route::post('/storeSalesManager', [StaffController::class, 'storeSalesManager'])->name('storeSalesManager');
Route::get('/designations', [StaffController::class, 'showDesignations'])->name('designations');
Route::post('/designation-save', [StaffController::class, 'addDesignation'])->name('designation-save');
Route::get('/officeTeams', [StaffController::class, 'showOfficeTeams'])->name('officeTeams');
Route::post('/officeTeams-save', [StaffController::class, 'addOfficeTeams'])->name('officeTeams-save');

// Partner Management routes
Route::get('/dealer-category', [PartnerManagementController::class, 'index'])->name('dealer-category');
Route::post('/dealer-category-save', [PartnerManagementController::class, 'save'])->name('dealer-category-save');

// dealer management
Route::get('/dealers', [PartnerManagementController::class, 'dealers'])->name('dealers');
Route::post('/dealer-save', [PartnerManagementController::class, 'saveDealer'])->name('dealer-save');
Route::get('/get-cities', [PartnerManagementController::class, 'getCities'])->name('get-cities');
Route::get('/view-dealer-sales-manager/{id}', [PartnerManagementController::class, 'viewDealerSalesManager'])->name('view-dealer-sales-manager');
Route::post('/allocate-dealer-sales-manager/{id}', [PartnerManagementController::class, 'allocateDealerSalesManager'])->name('allocate-dealer-sales-manager');
Route::get('/unallocate-dealer-sales-manager/{dealerId}/{userId}', [PartnerManagementController::class, 'unallocateDealerSalesManager'])->name('unallocate-dealer-sales-manager');
Route::get('/allocate-brand-dealer/{id}', [PartnerManagementController::class, 'allocateBrandDealer'])->name('allocate-brand-dealer');
Route::post('/allocate-brand-dealer-save/{id}', [PartnerManagementController::class, 'allocateBrandDealerSave'])->name('allocate-brand-dealer-save');

// dealer price list
Route::get('/view-dealer-price-list/{id}/{categoryId}', [PartnerManagementController::class, 'viewDealerPriceList'])->name('view-dealer-price-list');

Route::get('/brand-discount/{id}', [PartnerManagementController::class, 'brandDiscount'])->name('brand-discount');
Route::post('/brand-discount-save/{id}', [PartnerManagementController::class, 'addBrandDiscount'])->name('brand-discount-save');
Route::post('/brand-discount-bulk-save/{id}', [PartnerManagementController::class, 'saveBrandDiscount'])->name('brand-discount-bulk-save');

// Master Controller
Route::get('/business-category', [MasterController::class, 'businessCategory'])->name('business-category');
Route::post('/business-category-save', [MasterController::class, 'saveBusinessCategory'])->name('business-category-save');

Route::get('/department', [MasterController::class, 'department'])->name('department');
Route::post('/department-save', [MasterController::class, 'saveDepartment'])->name('department-save');

Route::get('/property-stage', [MasterController::class, 'propertyStage'])->name('property-stage');
Route::post('/property-stage-save', [MasterController::class, 'savePropertyStage'])->name('property-stage-save');

Route::get('/source', [MasterController::class, 'source'])->name('source');
Route::post('/source-save', [MasterController::class, 'saveSource'])->name('source-save');

Route::get('/property-category', [MasterController::class, 'propertyCategory'])->name('property-category');
Route::post('/property-category-save', [MasterController::class, 'savePropertyCategory'])->name('property-category-save');

Route::get('/property-sub-category', [MasterController::class, 'propertySubCategory'])->name('property-sub-category');
Route::post('/property-sub-category-save', [MasterController::class, 'savePropertySubCategory'])->name('property-sub-category-save');

Route::get('/product-category', [MasterController::class, 'productCategory'])->name('product-category');
Route::post('/product-category-save', [MasterController::class, 'saveProductCategory'])->name('product-category-save');

Route::get('/product-sub-category', [MasterController::class, 'productSubCategory'])->name('product-sub-category');
Route::post('/product-sub-category-save', [MasterController::class, 'saveProductSubCategory'])->name('product-sub-category-save');

Route::get('/product-uom', [MasterController::class, 'productUOM'])->name('product-uom');
Route::post('/product-uom-save', [MasterController::class, 'saveProductUOM'])->name('product-uom-save');

Route::get('/products', [MasterController::class, 'products'])->name('products');
Route::post('/product-save',[MasterController::class,'saveProduct'])->name('product-save');
Route::post('/import-products', [MasterController::class, 'importProducts'])->name('products.import');

// Admin, Coordinator, VP named routes (preserve existing controllers/views)
Route::get('/coordinator/dashboard', [\App\Http\Controllers\Coordinator\DashboardController::class, 'index'])->name('coordinator.dashboard');
Route::get('/vp/dashboard', function () {
    return view('vp.dashboard');
})->name('vp.dashboard');
