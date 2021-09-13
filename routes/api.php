<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Http\Middleware;
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

Route::post('registrstudent', 'App\Http\Controllers\StudentController@Registr');
Route::post('loginstudent', 'App\Http\Controllers\StudentController@Login');
Route::post('logoutstudent', 'App\Http\Controllers\StudentController@Logout')->middleware([App\Http\Middleware\StudyValid::class]);
Route::get('getstudent', 'App\Http\Controllers\StudentController@getStud');
Route::post('addstudent', 'App\Http\Controllers\StudentController@addStud');
Route::patch('updatestudent', 'App\Http\Controllers\StudentController@updateStud');
Route::post('delstudent', 'App\Http\Controllers\StudentController@deletStud');