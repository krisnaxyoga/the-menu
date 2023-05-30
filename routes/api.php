<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/add-to-cart',[\App\Http\Controllers\Api\CartController::class, 'addToCart'])->name('addtocart');
Route::post('/update-cart',[\App\Http\Controllers\Api\CartController::class, 'updateCart'])->name('updatecart');
Route::post('/checkout',[\App\Http\Controllers\Api\CartController::class, 'checkout'])->name('checkout');
Route::get('/menu',[\App\Http\Controllers\Api\CartController::class, 'menu'])->name('menu');
Route::post('/remove-from-cart',[\App\Http\Controllers\Api\CartController::class, 'removeFromCart'])->name('removecart');

Route::get('/data',[\App\Http\Controllers\Api\PesananController::class, 'index'])->name('data.index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
