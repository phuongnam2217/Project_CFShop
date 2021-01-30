<?php

use App\Http\Controllers\AuthController;
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

//Login
Route::get('login',[AuthController::class,'showFormlogin'])->name('showFormLogin');
Route::post('login',[AuthController::class,'login'])->name('login');

Route::middleware('auth')->prefix('/')->group(function (){
//    Logout
    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/', function () {
        return view('managers/home/home');
    })->name('home');

    Route::get('tables', function () {
        return view('managers/tables/table');
    })->name('tables');

    Route::get('products', function () {
        return view('managers/products/product');
    })->name('products');

    Route::get('resources', function () {
        return view('managers/resources/resource');
    })->name('resources');

    Route::get('invoices', function () {
        return view('managers/invoices/invoice');
    })->name('invoices');

    Route::get('reports', function () {
        return view('managers/reports/report');
    })->name('reports');


});
//
//Route::get('/', function () {
//    return view('managers/layout/master');
//})->name('admin.dashboard');


