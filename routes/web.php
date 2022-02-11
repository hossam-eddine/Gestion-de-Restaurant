<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\TableController;

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

Auth::routes(["register"=>false,"reset"=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource("categories",CategoryController::class);
Route::resource("tables",TableController::class);
Route::resource("servants",ServantController::class);
Route::resource("menus",MenuController::class);
Route::resource("sales",SaleController::class);

Route::get("payment",[PaymentController::class,"index"])->name("payment.index");
Route::get("reports",[ReportController::class,"index"])->name("report.index");
Route::post("reports/generate",[ReportController::class,"generate"])->name("report.generate");
Route::post("reports/export",[ReportController::class,"export"])->name("report.export");