<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
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

//Route::post('/admins/create-main-admin', function(){
//    \App\Admin::create([
//        'name' => 'aref',
//        'password' => \Illuminate\Support\Facades\Hash::make('aref'),
//        'permission' => true,
//    ]);
//    return 'ok';
//});


Route::post('/admins/login', [AdminController::class, 'login']);

Route::group(['middleware' => ['auth:admin']], function(){
    Route::post('/admins', [AdminController::class, 'store']);

    Route::post('/products', [ProductController::class, 'store']);

    Route::get('/products/{id}', [ProductController::class, 'getById']);

    Route::get('/products', [ProductController::class, 'get']);

    Route::delete('/products/{id}', [ProductController::class, 'deleteById']);

    Route::put('/products/{id}', [ProductController::class, 'updateById']);
});
