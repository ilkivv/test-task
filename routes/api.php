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

Route::namespace('api\v1')->prefix('v1')->group(function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'auth:api','cors'], function () {

        Route::get('schools', 'SchoolController@getAllSchools');
        Route::get('school/{id}', 'SchoolController@getSchoolById');
        Route::post('school', 'SchoolController@addSchool');
        Route::put('school/{id}', 'SchoolController@updateSchoolById');
        Route::delete('school/{id}', 'SchoolController@deleteSchoolById');

        Route::get('logout', 'AuthController@logout');

        Route::get('users', 'UserController@getUsers');

        Route::get('roles', 'RoleController@getRoles');
        Route::post('role', 'RoleController@addRole');
        Route::put('role/{id}', 'RoleController@updateRole');
        Route::delete('role/{id}', 'RoleController@deleteRole');

        Route::get('users/{type}', 'UserController@getAllUsers');
        Route::get('users/{type}/{school_id}', 'UserController@getAllUsersBySchoolId');
        Route::post('users/{type}', 'UserController@addUsers');
        Route::put('users/{type}/{id}', 'UserController@updateUsersById');
        Route::delete('users/{type}/{id}', 'UserController@deleteUsersById');

//        Route::get('workers', 'UserController@getAllWorkers');
//        Route::get('workers/{school_id}', 'UserController@getAllWorkersByWorkerId');
//        Route::post('worker', 'UserController@addWorker');
//        Route::put('worker/{id}', 'UserController@updateWorkerById');
//        Route::delete('worker/{id}', 'UserController@deleteWorkerById');

    });

});


