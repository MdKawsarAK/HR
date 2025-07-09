<?php

use App\Http\Controllers\About\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\PayrollInvoiceController;
// use App\Http\Controllers\PayrollInvoiceController;


Route::get('/', function () {
    return view('pages.dashboard.home');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.home');
})->name('dashboard');


// Route::get('/', function () {
//     return view('pages.about.index');
// });

Route::get('user', [UserController::class,"user"]);
Route::get('about', [AboutController::class,'index']);
Route::get('about', [AboutController::class,'index']);

Route::resource('products', ProductController::class);



Route::resource('districts', App\Http\Controllers\DistrictController::class);
Route::resource('districts', App\Http\Controllers\DistrictController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('leave_applications', App\Http\Controllers\LeaveApplicationController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('bloods', App\Http\Controllers\BloodController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('attendances', App\Http\Controllers\AttendanceController::class);
Route::resource('attendancemethods', App\Http\Controllers\AttendancemethodController::class);
Route::resource('departments', App\Http\Controllers\DepartmentController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('leave_applications', App\Http\Controllers\Leave_ApplicationController::class);
Route::resource('jobs', App\Http\Controllers\JobController::class);


// Route::get('/payroll/invoice/generate/{employeeId}', [PayrollInvoiceController::class, 'generate'])->name('payroll.invoice.generate');
// Route::get('/payroll/invoice/show/{invoiceId}', [PayrollInvoiceController::class, 'show'])->name('payroll.invoice.show');
// Route::resource('PayrollInvoice', App\Http\Controllers\PayrollInvoiceController::class);



    Route::get('/invoices', [PayrollInvoiceController::class, 'index'])->name('payroll.invoices.index');
    Route::get('/invoices/create', [PayrollInvoiceController::class, 'create'])->name('payroll.invoices.create');
    Route::post('/invoices', [PayrollInvoiceController::class, 'store'])->name('payroll.invoices.store');
    Route::get('/invoices/{id}', [PayrollInvoiceController::class, 'show'])->name('payroll.invoices.show');
    Route::get('/invoices/{id}/edit', [PayrollInvoiceController::class, 'edit'])->name('payroll.invoices.edit');
    Route::put('/invoices/{id}', [PayrollInvoiceController::class, 'update'])->name('payroll.invoices.update');
    Route::delete('/invoices/{id}', [PayrollInvoiceController::class, 'destroy'])->name('payroll.invoices.destroy');

Route::resource('payrollitems', App\Http\Controllers\PayrollitemController::class);
Route::resource('payrollitemtypes', App\Http\Controllers\PayrollitemtypeController::class);
Route::resource('types', App\Http\Controllers\TypeController::class);

Route::get('/payroll/invoices', [PayrollInvoiceController::class, 'index'])->name('payroll.invoices.index');
