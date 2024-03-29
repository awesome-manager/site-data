<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('ajax')->group(function () {
    Route::group(['prefix' => 'idm', 'namespace' => 'Idm'], function () {
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::post('login', 'AuthController@login');
            Route::post('refresh', 'AuthController@refresh');

            Route::group(['middleware' => 'auth:idm'], function () {
                Route::get('user', [
                    'uses' => 'AuthController@user'
                ]);

                Route::delete('logout', [
                    'uses' => 'AuthController@logout'
                ]);
            });
        });
    });

    Route::group(['prefix' => 'site', 'namespace' => 'Site'], function () {
        Route::group(['prefix' => 'menu', 'namespace' => 'Menu'], function() {
            Route::get('/', [
                'uses' => 'MenuController@data',
                'as' => 'ajax.site.menu'
            ]);
        });
    });

    Route::group(['prefix' => 'page', 'namespace' => 'Pages', 'middleware' => ['auth:idm', 'page.available', 'page.filter']], function () {
        Route::group(['prefix' => 'employees', 'namespace' => 'Employees'], function() {
            Route::get('/', [
                'uses' => 'EmployeeController@data',
                'as' => 'ajax.page.employees'
            ]);
        });

        Route::group(['prefix' => 'vacations', 'namespace' => 'Vacations'], function () {
            Route::get('/', [
                'uses' => 'VacationController@data',
                'as' => 'ajax.page.vacations'
            ]);
        });

        Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {
            Route::post('/update', [
                'uses' => 'UserController@updateUserInfo'
            ]);

            Route::group(['prefix' => 'image'], function () {
                Route::post('/', [
                    'uses' => 'UserImageController@createUserImage'
                ]);

                Route::delete('/', [
                    'uses' => 'UserImageController@deleteUserImage'
                ]);
            });
        });

        Route::group(['prefix' => 'projects', 'namespace' => 'Projects'], function () {
            Route::get('/', [
                'uses' => 'ProjectController@data',
                'as' => 'ajax.page.projects'
            ]);

            Route::get('/gantt', [
                'uses' => 'GanttController@data',
                'as' => 'ajax.page.projects.gantt'
            ]);

            Route::get('/add', [
                'uses' => 'AddProjectController@data',
                'as' => 'ajax.page.projects.add_data'
            ]);

            Route::post('/add', [
                'uses' => 'AddProjectController@create',
                'as' => 'ajax.page.projects.create'
            ]);
        });
    });
});
