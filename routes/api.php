<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StudentController;
use \App\Http\Controllers\ClassController;
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


//      -> students

Route::post('/students', [StudentController::class, 'store']);

Route::get('/students/user_class/{id}', [StudentController::class, 'getClass']);

Route::get('/students/{id}', [StudentController::class, 'getById']);

Route::post('/students/add_to_class', [StudentController::class, 'addToClass']);
//      -> classes

Route::post('/classes', [ClassController::class, 'store']);
