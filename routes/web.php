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
    Route::group(['prefix' => 'page', 'namespace' => 'Pages'], function () {
        Route::group(['prefix' => 'employees', 'namespace' => 'Employees'], function() {
            Route::get('/', [
                'uses' => 'EmployeeController@data',
                'as' => 'ajax.page.employees.data'
            ]);
        });
    });
});
