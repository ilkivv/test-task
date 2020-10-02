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


Route::middleware(['auth:api','cors'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api\v1')->prefix('v1')->group(function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');


    Route::get('workers', 'UserController@getWorkers');
    Route::post('worker', 'UserController@addWorker');
    Route::put('worker/{id}', 'UserController@updateWorker');
    Route::delete('worker/{id}', 'UserController@deleteWorker');


    Route::group(['middleware' => 'auth:api','cors'], function () {

        Route::get('schools', 'SchoolController@getSchools');
        Route::post('school', 'SchoolController@addSchool');
        Route::put('school/{id}', 'SchoolController@updateSchool');
        Route::delete('school/{id}', 'SchoolController@deleteSchool');

        Route::get('logout', 'AuthController@logout');
        Route::get('users', 'UserController@getUsers');

        Route::get('roles', 'RoleController@getRoles');
        Route::post('role', 'RoleController@addRole');
        Route::put('role/{id}', 'RoleController@updateRole');
        Route::delete('role/{id}', 'RoleController@deleteRole');

        Route::get('students', 'UserController@getAllStudents');
        Route::post('students', 'UserController@addStudent');
        Route::put('students/{id}', 'UserController@updateStudent');
        Route::delete('students/{id}', 'UserController@deleteStudent');

    });

});


