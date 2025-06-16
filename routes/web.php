<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Inventory\ProductController;

Route::get('/', function () {
    return view('pages.dashboard.home');
});

// Route::get('/', function () {
//     return view('pages.about.index');
// });

Route::get('user', [UserController::class,"user"]);
Route::get('about', [AboutController::class,'index']);
Route::get('about', [AboutController::class,'index']);

Route::resource('products', ProductController::class);

Route::resource('hotels', App\Http\Controllers\HotelController::class);
Route::resource('cattles', App\Http\Controllers\CattleController::class);
Route::resource('cattle', App\Http\Controllers\CattleController::class);
Route::resource('cattle', App\Http\Controllers\CattleController::class);
Route::resource('hotels', App\Http\Controllers\HotelController::class);
Route::resource('districts', App\Http\Controllers\DistrictController::class);
Route::resource('districts', App\Http\Controllers\DistrictController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);