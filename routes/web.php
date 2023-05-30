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
    Route::get('/menu/{table}', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('menu');
    Route::post('/customer/store',[\App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');
    Route::get('/food/{table}/{cust}',[\App\Http\Controllers\MenuController::class, 'index'])->name('menu.food');
    Route::get('/cart/{table}/{cust}',[\App\Http\Controllers\MenuController::class, 'cart'])->name('cart');
    Route::get('/orderlist/{table}/{cust}',[\App\Http\Controllers\MenuController::class, 'orderlist'])->name('orderlist');
});

Route::group(['middleware' => ['authtwo']], function() {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/home', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');
    Route::resource('/category',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/product',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/table',\App\Http\Controllers\Admin\TableController::class);
    Route::resource('/category',\App\Http\Controllers\Admin\CategoryController::class);
    Route::get('/order',[\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
    Route::post('/order/store',[\App\Http\Controllers\Admin\OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{custid}',[\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('order.show');
    
    Route::get('/orderbayar/{custid}',[\App\Http\Controllers\Admin\OrderController::class, 'paid'])->name('order.bayar');
    Route::get('/orderselesai/{custid}',[\App\Http\Controllers\Admin\OrderController::class, 'showselesai'])->name('order.showselesai');
    Route::get('/customer',[\App\Http\Controllers\Admin\CustomerController::class, 'cust'])->name('customer.index');
    Route::get('/report',[\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('report.index');
    Route::get('/setting',[\App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/update',[\App\Http\Controllers\SettingController::class, 'update'])->name('setting.update');
  
    Route::get('/createmenu/{id}',[\App\Http\Controllers\Admin\TableController::class,'createmenu'])->name('createmenu');
});