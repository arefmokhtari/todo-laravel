<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\AdminController;
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

//      admin
Route::post('/admin', [AdminController::class, 'test']);

Route::post('/admin/login', [AdminController::class, 'register']);
//      products
Route::get('/products', [ProductController::class, 'get']);

Route::get('/products/{id}', [ProductController::class, 'getById']);

//
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/products', [ProductController::class, 'store']);

    Route::put('/products/{id}', [ProductController::class, 'updateById']);

    Route::delete('/products/{id}', [ProductController::class, 'deleteById']);
});
//

