<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api\v1')->prefix('v1')->group(function () {
    Route::get('schools', 'SchoolController@getSchools');
    Route::post('school', 'SchoolController@addSchool');
    Route::put('school/{id}', 'SchoolController@updateSchool');
    Route::delete('school/{id}', 'SchoolController@deleteSchool');

    Route::get('workers', 'UserController@getWorkers');
    Route::post('worker', 'UserController@addWorker');
    Route::put('worker/{id}', 'UserController@updateWorker');
    Route::delete('worker/{id}', 'UserController@deleteWorker');
});


