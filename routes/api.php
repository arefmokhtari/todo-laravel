<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\CategoryController;
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

//      -> user
Route::post('/user', [UserController::class, 'store']);

Route::post('/user/login', [UserController::class, 'login']);

Route::post('/user/send-code', [UserController::class, 'sendCode']);

Route::post('/user/check-otp', [UserController::class, 'checkOtp']);
//      -> Admin:

Route::post('/admin', [AdminController::class, 'login']);

Route::group(['middleware' => ['auth:user']], function(){
    Route::get('/user',[UserController::class,'getInfo']);

    Route::put('/user', [UserController::class, 'update']);

    Route::post('/user/change-password', [UserController::class, 'changePassword']);
});

Route::group(['middleware' => ['auth:admin']], function(){
    Route::post('/category', [CategoryController::class, 'store']);
});
//Route::post('/admin/create', function (){
//    \App\Models\Admin::create([
//        'name' => 'aref',
//        'password' => \Illuminate\Support\Facades\Hash::make('aref'),
//    ]);
//    return \App\Helpers\Helper::result(null, [ 'ok' => true ]);
//});


