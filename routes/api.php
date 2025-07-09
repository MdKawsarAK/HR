<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Inventory\ProductController;
use App\Http\Controllers\Api\Inventory\ProductCategoryController;
use App\Http\Controllers\Api\HR\EmployeeController;
use App\Http\Controllers\Api\DistrictsController;
use App\Http\Controllers\Api\PayrollInvoiceController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::get('productcategory/{id}/filter',[ProductCategoryController::class,'filter']);

Route::apiResources([
    'products' => ProductController::class,
]);
 Route::apiResources([
    'products' => ProductController::class,
]);

Route::apiResources([
    'productcategory'=>ProductCategoryController::class
]);

// Route::apiResources([
//     'district'=>DistrictsController::class
// ]);
Route::apiResource('district', districtsController::class);
// Route::apiResource('payrollinvoice', PayrollInvoiceController::class);


    Route::get('invoices', [PayrollInvoiceController::class, 'index']);       // GET all invoices
    Route::post('invoices', [PayrollInvoiceController::class, 'store']);      // POST create invoice
    Route::get('invoices/{id}', [PayrollInvoiceController::class, 'show']);   // GET single invoice
    Route::put('invoices/{id}', [PayrollInvoiceController::class, 'update']); // PUT update invoice
    Route::delete('invoices/{id}', [PayrollInvoiceController::class, 'destroy']); // DELETE invoice
