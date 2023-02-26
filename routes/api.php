<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
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

//      -> Admin:

Route::post('/admin', [AdminController::class, 'login']);

//Route::post('/admin/create', function (){
//    \App\Models\Admin::create([
//        'name' => 'aref',
//        'password' => \Illuminate\Support\Facades\Hash::make('aref'),
//    ]);
//    return \App\Helpers\Helper::result(['ok' => true]);
//});


