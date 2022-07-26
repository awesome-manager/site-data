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
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function ($router) {
            $router->post('login', 'AuthController@login');
            $router->get('user', [
                'middleware' => 'auth:idm',
                'uses' => 'AuthController@user'
            ]);
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

    Route::group(['prefix' => 'page', 'namespace' => 'Pages', 'middleware' => ['auth:idm', 'page.available']], function () {
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
