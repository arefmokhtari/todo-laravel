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

//      -> classes

Route::post('/classes', [ClassController::class, 'store']);

Route::get('classes/student/{classId}', [ClassController::class, 'getStudentByClassId']);
Route::get('/classes/{id}', [ClassController::class, 'getById']);

//      -> add student to class
Route::post('/classes/add_student', [ClassController::class, 'addStudent']);

//      -> students

Route::post('/students', [StudentController::class, 'store']);

Route::get('/students/class/{studentId}', [StudentController::class, 'getClass']);

Route::get('/students/{id}', [StudentController::class, 'getById']);


