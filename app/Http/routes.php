<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('results', 'ResultController@index');

Route::get('results/create', 'ResultController@create');

Route::post('results', 'ResultController@store');

Route::get('api/results/all', 'ResultController@all');

Route::get('api/results/latest', 'ResultController@latest');

Route::get('api/results/{id}', 'ResultController@getById');


