<?php

use App\Http\Controllers\AddCartController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BaseSalaryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpendController;
use App\Http\Controllers\ExpendOptionsController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeOptionsController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StaffInfoController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\WorkplaceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/positions', PositionController::class);
Route::post('/update-positions', [App\Http\Controllers\PositionController::class, 'updatePosition']);
Route::resource('/workplace', WorkplaceController::class);
Route::post('/update-workplace', [App\Http\Controllers\WorkplaceController::class, 'updateWorkplace']);
Route::resource('/base-salary', BaseSalaryController::class);
Route::post('/update-base-salary', [App\Http\Controllers\BaseSalaryController::class, 'updateBaseSalary']);
Route::resource('/staff-info', StaffInfoController::class);
Route::resource('/customers', CustomerController::class);
Route::post('/new-customer', [App\Http\Controllers\CustomerController::class, 'newCustomer']);

Route::get('attachments/download/{file}', [App\Http\Controllers\AttachmentController::class, 'download']);
Route::resource('/times', TimeController::class);
Route::post('/update-times', [App\Http\Controllers\TimeController::class, 'updateTime']);
Route::resource('/income-options', IncomeOptionsController::class);
Route::post('/update-income-options', [App\Http\Controllers\IncomeOptionsController::class, 'updateOptionsIncome']);
Route::resource('/expend-options', ExpendOptionsController::class);
Route::post('/update-expend-options', [App\Http\Controllers\ExpendOptionsController::class, 'updateExpendOptions']);
Route::resource('/attendances', AttendanceController::class);
Route::get('list-staff', [App\Http\Controllers\AttendanceController::class, 'listStaff']);
Route::get('/filter-attendances/{id}', [App\Http\Controllers\AttendanceController::class, 'filterAttendances']);
Route::post('/update-attendance', [App\Http\Controllers\AttendanceController::class, 'updateAttendances']);
Route::resource('/payroll', PayrollController::class);
Route::resource('/incomes', IncomeController::class);
Route::resource('/expends', ExpendController::class);
Route::resource('/product-category', ProductCategoryController::class);
Route::resource('/productes', ProductController::class);
Route::delete('/productes/delete-photo/{id}',[App\Http\Controllers\ProductController::class, 'deletePhoto']);
Route::get('/get-product/{id}',[App\Http\Controllers\ProductController::class, 'getProduct']);
Route::resource('/sales', SaleController::class);
Route::get('/sales-cart-list', [App\Http\Controllers\SaleController::class, 'cartList']);
Route::resource('/add-cart', AddCartController::class);
Route::get('/print-add-cart/{id}', [App\Http\Controllers\AddCartController::class, 'print']);

