<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
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

//      products
Route::get('/products', [ProductController::class, 'get']);

Route::get('/products/{id}', [ProductController::class, 'getById']);

Route::post('/products', [ProductController::class, 'store']);

Route::put('/products/{id}', [ProductController::class, 'updateById']);

Route::delete('/products/{id}', [ProductController::class, 'deleteById']);

//
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
