<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['auth:user']], function(){
    Route::get('/user',[UserController::class,'get']);
});

//      -> user
Route::post('/user', [UserController::class, 'store']);

Route::post('/user/login', [UserController::class, 'login']);

//      -> Admin:

Route::post('/admin', [AdminController::class, 'login']);


//Route::post('/admin/create', function (){
//    \App\Models\Admin::create([
//        'name' => 'aref',
//        'password' => \Illuminate\Support\Facades\Hash::make('aref'),
//    ]);
//    return \App\Helpers\Helper::result(null, [ 'ok' => true ]);
//});


