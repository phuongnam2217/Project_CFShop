<?php

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

Route::get('index', function () {
    return view('managers/layout/master');
});

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

Route::get('/', function () {
    return view('managers/home/home');
})->name('home');

Route::get('reports', function () {
    return view('managers/reports/report');
})->name('reports');
