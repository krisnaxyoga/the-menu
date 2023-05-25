<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('dologin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/customer/create/{table}',[\App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customer.create');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');
    Route::resource('/category',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/product',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/table',\App\Http\Controllers\Admin\tableController::class);
    Route::resource('/category',\App\Http\Controllers\Admin\CategoryController::class);
    Route::get('/order',[\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
    Route::get('/customer',[\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer.index');
   
});