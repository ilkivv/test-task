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
        Route::get('schools/{id}', 'SchoolController@getSchoolById');
        Route::post('schools', 'SchoolController@addSchool');
        Route::put('schools/{id}', 'SchoolController@updateSchoolById');
        Route::delete('schools/{id}', 'SchoolController@deleteSchoolById');

        Route::get('logout', 'AuthController@logout');

        Route::get('roles', 'RoleController@getRoles');
        Route::post('roles', 'RoleController@addRole');
        Route::put('roles/{id}', 'RoleController@updateRole');
        Route::delete('roles/{id}', 'RoleController@deleteRole');

        Route::get('user/{id}', 'UserController@getUserById');

        Route::get('users/{type}', 'UserController@getAllUsers');
        Route::get('users/{type}/{school_id}', 'UserController@getAllUsersBySchoolId');
        Route::post('users', 'UserController@addUser');
        Route::put('users/{id}', 'UserController@updateUserById');
        Route::delete('users/{id}', 'UserController@deleteUserById');

        Route::put('users/exception-dismissal/{id}', 'UserController@exceptionOrDismissalUserById');
        Route::get('test', 'UserController@activateTransferStudents');

        Route::get('rating', 'RatingController@getStatistics');
        Route::post('rating', 'RatingController@addRating');
        Route::put('rating/{id}', 'RatingController@updateRating');
        Route::delete('rating/{id}', 'RatingController@deleteRating');
    });

});


