<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('products', [ProductController::class, 'importProducts']);
    Route::group(['prefix' => 'cart'], function () {
        Route::put('quantity', [CartController::class, 'updateQuantity']);
        Route::post('sync', [CartController::class, 'syncCart']);
        Route::delete('', [CartController::class, 'emptyCart']);
        Route::get('', [CartController::class, 'get']);
    });
    Route::post('checkout', [CheckoutController::class, 'checkout']);
    Route::get('products/count', [ProductController::class, 'getProductCount']);
    Route::get('products',[ProductController::class,'getProducts']);
});
