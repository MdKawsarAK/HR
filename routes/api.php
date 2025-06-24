<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Inventory\ProductController;
use App\Http\Controllers\Api\Inventory\ProductCategoryController;
use App\Http\Controllers\Api\HR\EmployeeController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::get('productcategory/{id}/filter',[ProductCategoryController::class,'filter']);

Route::apiResources([
    'products' => ProductController::class,
]);


Route::apiResources([
    'productcategory'=>ProductCategoryController::class
]);

Route::apiResources([
    'employees'=>employeeController::class
]);
