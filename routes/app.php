<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagingController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::middleware(['isGuest','isTimeout'])->group( function() {
    Route::controller(UploadController::class)->group(function () {
        Route::get ('output/upload', 'indexOutputUpload')->name('output.upload');
        Route::post('output/upload/import', 'outputImport')->name('output.import'); 
    });
});
Route::middleware(['isGuest','isTimeout'])->group( function() {
    Route::controller(MasterDataController::class)->group(function () {
        // WareHouse
        // Vendor
        Route::get ('master-data/vendor', 'indexVendor')->name('master.vendor');
        Route::post('master-data/vendor/store','storeVendor')->name('master.vendor.store');
        Route::post('master-data/vendor/edit/{id}','editVendor')->name('master.vendor.edit');
        Route::post('master-data/vendor/delete/{id}', 'deleteVendor')->name('master.vendor.delete');

        // Project
        // Item
    });
});
Route::middleware(['isGuest','isTimeout'])->group( function() {
    Route::controller(DashboardController::class)->group(function () {
        // Monitoring Menu Route
        Route::get('/dashboard/summary', 'dashboardSummary')->name('dashboard.summary');
        Route::get('/dashboard/history', 'dashboardHistory')->name('dashboard.history');
    });
});

Route::middleware(['isGuest','isTimeout'])->group( function() {
    Route::controller(TransactionController::class)->group(function () {

        Route::get ('/transaction/stock-in', 'indexStockin')->name('transaction.stockin');
        Route::post('/transaction/stock-in/store','storeStockin')->name('transaction.stockin.store');
        Route::get ('/transaction/stock-out', 'indexStockout')->name('transaction.stockout');
        Route::post('/transaction/stock-out/store', 'storeStockout')->name('transaction.stockout.store');
        Route::get ('/transaction/stock-manager', 'indexStockmanager')->name('transaction.stockmanager');

    });
});

Route::middleware(['isGuest','isTimeout'])->group( function() {
    Route::controller(ManagingController::class)->group(function() {
        //product
        Route::get ('/managing/product', 'indexProduct')->name('managing.product');
        Route::post('/managing/product/store', 'storeProduct')->name('managing.product.store');
        Route::post('/managing/product/delete/{id}','deleteProduct')->name('managing.product.delete');

        //supplier 
        Route::get ('managing/supplier', 'indexSupplier')->name('managing.supplier');
        Route::post('managing/supplier/store','storeSupplier')->name('managing.supplier.store');
        Route::post('managing/supplier/edit/{id}','editSupplier')->name('managing.supplier.edit');
        Route::post('managing/supplier/delete/{id}', 'deleteSupplier')->name('managing.supplier.delete');

        Route::get ('managing/supplier/category', 'indexSupplierCategory')->name('managing.supplier.category');
        Route::post('managing/supplier/category/store', 'storeSupplierCategory')->name('managing.supplier.category.store');
        Route::post('managing/supplier/category/edit/{id}', 'editSupplierCategory')->name('managing.supplier.category.edit');
        Route::post('managing/supplier/category/delete/{id}', 'deleteSupplierCategory')->name('managing.supplier.category.delete');

        // Employee
        Route::get ('managing/employee', 'indexEmployee')->name('managing.employee');
        Route::post('managing/employee/store', 'storeEmployee')->name('managing.employee.store');
        Route::post('managing/employee/edit/{id}', 'editEmployee')->name('managing.employee.edit');
        Route::post('managing/employee/delete/{id}', 'deleteEmployee')->name('managing.employee.delete');
        // Department
        Route::get ('managing/user', 'indexUser')->name('managing.user');
        Route::get ('managing/department', 'indexDepartment')->name('managing.department');
        Route::post('managing/department/store', 'storeDepartment')->name('managing.department.store');
        Route::post('managing/department/edit/{id}', 'editDepartment')->name('managing.department.edit');
        Route::post('managing/departmen/delete/{id}', 'deleteDepartment')->name('managing.department.delete');
        // Division
        Route::get ('managing/division', 'indexDivision')->name('managing.division');
        Route::post('managing/division/store', 'storeDivision')->name('managing.division.store');
        Route::post('managing/division/edit/{id}', 'editDivision')->name('managing.division.edit');
        Route::post('managing/division/delete/{id}', 'deleteDivision')->name('managing.division.delete');
    });
});