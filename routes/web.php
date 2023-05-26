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
    Route::get('/menu/{table}', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('menu');
    Route::post('/customer/store',[\App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');
    Route::get('/food/{table}',[\App\Http\Controllers\MenuController::class, 'index'])->name('menu.food');
    Route::post('/add-to-cart',[\App\Http\Controllers\MenuController::class, 'addToCart'])->name('addtocart');
    Route::post('/update-cart',[\App\Http\Controllers\MenuController::class, 'updateCart'])->name('updatecart');
    Route::post('/remove-from-cart',[\App\Http\Controllers\MenuController::class, 'removeFromCart'])->name('removecart');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');
    Route::resource('/category',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/product',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/table',\App\Http\Controllers\Admin\TableController::class);
    Route::resource('/category',\App\Http\Controllers\Admin\CategoryController::class);
    Route::get('/order',[\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
    Route::get('/customer',[\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer.index');
    Route::get('/createmenu/{id}',[\App\Http\Controllers\Admin\TableController::class,'createmenu'])->name('createmenu');
});