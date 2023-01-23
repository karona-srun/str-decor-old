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
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StaffInfoController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;
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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard-sale', [App\Http\Controllers\DashboardSaleController::class, 'index'])->name('dashboard-sale');
Route::resource('/positions', PositionController::class);
Route::post('/update-positions', [App\Http\Controllers\PositionController::class, 'updatePosition']);
Route::get('/position-exportexcel', [App\Http\Controllers\PositionController::class, 'positionExport']);
Route::resource('/workplace', WorkplaceController::class);
Route::post('/update-workplace', [App\Http\Controllers\WorkplaceController::class, 'updateWorkplace']);
Route::get('/workplace-exportexcel', [App\Http\Controllers\WorkplaceController::class, 'workplaceExportExcel']);

Route::resource('/base-salary', BaseSalaryController::class);
Route::post('/update-base-salary', [App\Http\Controllers\BaseSalaryController::class, 'updateBaseSalary']);
Route::resource('/staff-info', StaffInfoController::class);
Route::get('/staff-exportexcel', [App\Http\Controllers\StaffInfoController::class, 'staffExport']);

Route::resource('/customers', CustomerController::class);
Route::post('/new-customer', [App\Http\Controllers\CustomerController::class, 'newCustomer']);
Route::get('/customers-exportexcel', [App\Http\Controllers\CustomerController::class, 'customerExport']);

Route::get('attachments/download/{file}', [App\Http\Controllers\AttachmentController::class, 'download']);
Route::resource('/times', TimeController::class);
Route::post('/update-times', [App\Http\Controllers\TimeController::class, 'updateTime']);
Route::get('/times-exportexcel', [App\Http\Controllers\TimeController::class, 'timeExport']);

Route::resource('/income-options', IncomeOptionsController::class);
Route::post('/update-income-options', [App\Http\Controllers\IncomeOptionsController::class, 'updateOptionsIncome']);
Route::get('/income-options-exportexcel', [App\Http\Controllers\IncomeOptionsController::class, 'exportExcel']);

Route::resource('/expend-options', ExpendOptionsController::class);
Route::post('/update-expend-options', [App\Http\Controllers\ExpendOptionsController::class, 'updateExpendOptions']);
Route::get('/expend-options-exportexcel', [App\Http\Controllers\ExpendOptionsController::class, 'exportExcel']);

Route::resource('/attendances', AttendanceController::class);
Route::get('list-staff', [App\Http\Controllers\AttendanceController::class, 'listStaff']);
Route::get('/filter-attendances/{id}', [App\Http\Controllers\AttendanceController::class, 'filterAttendances']);
Route::post('/update-attendance', [App\Http\Controllers\AttendanceController::class, 'updateAttendances']);
Route::resource('/payroll', PayrollController::class);

Route::resource('/incomes', IncomeController::class);
Route::get('incomes-exportexcel',[App\Http\Controllers\IncomeController::class, 'exportExcel']);

Route::resource('/expends', ExpendController::class);
Route::get('expends-exportexcel',[App\Http\Controllers\ExpendController::class, 'exportExcel']);

Route::resource('/product-category', ProductCategoryController::class);
Route::get('/product-category-exportexcel', [App\Http\Controllers\ProductCategoryController::class, 'exportExcel']);

Route::resource('/productes', ProductController::class);
Route::delete('/productes/delete-photo/{id}',[App\Http\Controllers\ProductController::class, 'deletePhoto']);
Route::get('/productes-exportexcel',[App\Http\Controllers\ProductController::class, 'exportExcel']);

Route::get('/get-product/{id}',[App\Http\Controllers\ProductController::class, 'getProduct']);
Route::resource('/sales', SaleController::class);
Route::get('/sales-cart-list', [App\Http\Controllers\SaleController::class, 'cartList']);
Route::get('/sale-report', [App\Http\Controllers\SaleController::class, 'Report']);
Route::resource('/add-cart', AddCartController::class);
Route::get('/print-add-cart/{id}', [App\Http\Controllers\AddCartController::class, 'print']);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UserController::class);
    Route::get('/users/reset-password/{id}', [App\Http\Controllers\UserController::class, 'resetPassword']);
    Route::post('/users/update-password', [App\Http\Controllers\UserController::class, 'updatePassword']);
    Route::get('users/toggle-blocked/{id}/{blocked}', [App\Http\Controllers\UserController::class, 'toggleBlocked']);
    Route::get('/users/profile/{id}', [App\Http\Controllers\UserController::class, 'profile']);
    Route::get(' users-exportexcel', [App\Http\Controllers\UserController::class, 'exportExcel']);
    Route::resource('roles', RolesController::class);
});