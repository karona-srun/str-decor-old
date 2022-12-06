<?php

use App\Http\Controllers\BaseSalaryController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StaffInfoController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\WorkplaceController;
use App\Models\Workplace;
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
Route::get('attachments/download/{file}', [App\Http\Controllers\AttachmentController::class, 'download']);
Route::resource('/times', TimeController::class);
Route::post('/update-times', [App\Http\Controllers\TimeController::class, 'updateTime']);