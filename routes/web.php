<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
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

    Route::prefix('users')->group(function (){
        Route::get('/',[UserController::class,'index'])->name('users.index');
        Route::get('{id}',[UserController::class,'show'])->name('users.show');
        Route::post('/',[UserController::class,'store'])->name('users.store');
        Route::put('{id}',[UserController::class,'update'])->name('users.update');
        Route::get('{id}/delete',[UserController::class,'destroy'])->name('users.destroy');
        Route::get('{id}/changeActive',[UserController::class,'changeActive'])->name('users.changeActive');
    });

    Route::prefix('profile')->group(function (){
        Route::get('/',[ProfileController::class,'show'])->name('profile.show');
        Route::post('/',[ProfileController::class,'update'])->name('profile.update');
        Route::post('changPassword',[ProfileController::class,'changePassword'])->name('profile.changePassword');
    });

    Route::get('tables', [TableController::class, 'index'])->name('table.index');

    Route::prefix('group')->group(function (){
        Route::post('/', [GroupController::class, 'store'])->name('group.store');
        Route::put('/update/{id}', [GroupController::class, 'update']);
        Route::delete('/delete/{id}', [GroupController::class, 'delete']);
    });

    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/add', [ProductController::class, 'store']);
        Route::put('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/delete/{id}', [ProductController::class, 'delete']);
        Route::get('{id}',[ProductController::class,'show']);
        Route::post('/search', [ProductController::class, 'search'])->name('product.search');
    });

    Route::prefix('category')->group(function (){
    Route::post('/add', [CategoryController::class, 'store']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
    });

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


