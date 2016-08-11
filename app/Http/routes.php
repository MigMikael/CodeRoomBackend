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

Route::get('submissions', 'SubmissionController@index');
Route::get('submissions/create', 'SubmissionController@create');
Route::post('submissions', 'SubmissionController@store');


Route::get('results', 'ResultController@index');
Route::get('results/create', 'ResultController@create');
Route::post('results', 'ResultController@store');


Route::get('problems', 'ProblemController@index');
Route::get('problems/create', 'ProblemController@create');
Route::post('problems', 'ProblemController@store');


/*Route::get('problems_analysis', 'ProblemAnalysisController@index');
Route::get('problems_analysis/create', 'ProblemAnalysisController@create');
Route::get('problems_analysis/{id}', 'ProblemAnalysisController@show');
Route::post('problems_analysis', 'ProblemAnalysisController@store');
Route::get('problems_analysis/{id}/edit', 'ProblemAnalysisController@edit');*/
Route::resource('problem_analysis', 'ProblemAnalysisController');
Route::post('problem_analysis/score', 'ProblemAnalysisController@keepScore');


Route::get('problemfile', 'ProblemFileController@index');
Route::get('problemfile/create', 'ProblemfileController@create');
Route::get('problemfile/get/{filename}', ['as' => 'getfile', 'uses' => 'ProblemFileController@get']);
Route::post('problemfile/add', ['as' => 'addfile', 'uses' => 'ProblemFileController@add']);
Route::get('problemfile/getQuestion/{prob_id}', 'ProblemFileController@getQuestion');
Route::get('problemfile/test', 'ProblemFileController@test');

Route::resource('course', 'CourseController');


Route::resource('lesson', 'LessonController');


Route::get('api/results/{user_id}/latest', 'ResultController@latestResult')->middleware(['cors']);


Route::get('api/results/{user_id}/all', 'ResultController@allResult');
Route::get('api/problems_analysis/latest', 'ProblemAnalysisController@latestAnalysis');
Route::get('api/problems_analysis/{prob_id}', 'ProblemAnalysisController@getById');

/*

http://localhost:8888/api/problems_analysis

*/
Route::auth();

Route::get('/home', 'HomeController@index');
