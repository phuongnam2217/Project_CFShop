<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResourceController;
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

    Route::get('/' ,[HomeController::class,'index'])->name('home');

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

    Route::prefix('tables')->group(function (){
        Route::get('/', [TableController::class, 'index'])->name('table.index');
        Route::post('/',[TableController::class,'store'])->name('table.store');
        Route::get('{id}',[TableController::class,'show'])->name('table.show');
        Route::put('{id}/update',[TableController::class,'update'])->name('table.update');
        Route::get('{id}/delete',[TableController::class,'delete'])->name('table.destroy');
        Route::get('{id}/changeActive',[TableController::class,'changeActive'])->name('table.changeActive');
        Route::get('{id}/viewTable',[TableController::class,'getViewTable'])->name('table.viewTable');
    });

    Route::prefix('group')->group(function (){
        Route::get('/',[GroupController::class,'index'])->name('group.index');
        Route::post('/', [GroupController::class, 'store'])->name('group.store');
        Route::get('view-select',[GroupController::class,'viewSelect'])->name('group.select');
        Route::get('{id}',[GroupController::class,'show'])->name('group.show');
        Route::put('{id}/update', [GroupController::class, 'update'])->name('group.update');
        Route::get('{id}/delete', [GroupController::class, 'delete'])->name('group.destroy');
    });

    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/add', [ProductController::class, 'store'])->name('product.store');
        Route::put('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/delete/{id}', [ProductController::class, 'delete']);
        Route::get('{id}',[ProductController::class,'show']);
        Route::post('/search', [ProductController::class, 'search'])->name('product.search');
        Route::get('{id}/changeActive',[ProductController::class,'changeActive'])->name('product.changeActive');
        Route::get('/active/{id}',[ProductController::class, 'showActive']);
    });

    Route::prefix('category')->group(function (){
    Route::post('/add', [CategoryController::class, 'store']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete/{id}', [CategoryController::class, 'delete']);
    });

    Route::get('invoices', function () {
        return view('managers/invoices/invoice');
    })->name('invoices');

    Route::prefix('orders')->group(function (){
        Route::get('/',[OrderController::class,'index'])->name('orders.index');
        Route::get('/{id}',[OrderController::class,'showProduct']);
        Route::post('/search', [OrderController::class, 'search']);
        Route::get('{id}/viewCard',[OrderController::class,'viewCart']);
        Route::post('add',[OrderController::class,'add'])->name('orders.add');
        Route::put('{id}/delete',[OrderController::class,'delete'])->name('orders.delete');
        Route::put('{id}/remove',[OrderController::class,'remove'])->name('orders.remove');
        Route::put('{id}/changeStatus',[OrderController::class,'changeStatusOrderDetail'])->name('orders.changeStatus');

        Route::get('{id}/viewPayment',[OrderController::class,'viewPayment'])->name('orders.viewPayment');
        Route::put('{id}/payment',[OrderController::class,'payment'])->name('orders.payment');

    });

    Route::prefix('invoice')->group(function (){
        Route::get('/',[InvoiceController::class,'index'])->name('invoice.index');
        Route::get('{id}',[InvoiceController::class,'show']);
        Route::post('/search', [InvoiceController::class, 'search']);
        Route::get('/time/{id}',[InvoiceController::class, 'showTime']);
    });

    Route::prefix('resource')->group(function (){
        Route::get('/',[ResourceController::class,'index'])->name('resource.index');
        Route::post('/add',[ResourceController::class, 'store']);
        Route::delete('/delete/{id}', [ResourceController::class, 'delete']);
        Route::post('/addResource',[ResourceController::class, 'addResource']);
        Route::delete('/destroy/{id}', [ResourceController::class, 'deleteResource']);
        Route::post('/search', [ResourceController::class, 'search']);
    });

    Route::prefix('importProduct')->group(function (){
        Route::get('/',[ImportProductController::class,'index'])->name('importProduct.index');
        Route::post('/add',[ImportProductController::class, 'store']);
        Route::delete('/delete/{id}', [ImportProductController::class, 'delete']);
        Route::post('/search', [ImportProductController::class, 'search']);
    });

    Route::prefix('reports')->group(function (){
    Route::get('/', [ReportController::class,'index'])->name('reports.index');
        Route::get('/time/{id}',[ReportController::class, 'showTime']);
    });
});


