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


Route::resource('problems', 'ProblemController');
Route::resource('problem_analysis', 'ProblemAnalysisController');
Route::resource('course', 'CourseController');
Route::resource('lesson', 'LessonController');
Route::resource('submissions', 'SubmissionController');
Route::resource('results', 'ResultController');
Route::resource('student', 'StudentController');
Route::resource('student_course', 'StudentCourseController');
Route::resource('announcement', 'AnnouncementController');

Route::get('problemfile', 'ProblemFileController@index');
Route::get('problemfile/create', 'ProblemFileController@create');
Route::get('problemfile/get/{filename}', ['as' => 'getfile', 'uses' => 'ProblemFileController@get']);
Route::post('problemfile/add', ['as' => 'addfile', 'uses' => 'ProblemFileController@add']);
Route::get('problemfile/getQuestion/{prob_id}', 'ProblemFileController@getQuestion');


Route::post('problem_analysis/score', 'ProblemAnalysisController@keepScore');


Route::get('api/results/{user_id}/latest', 'ResultController@latestResult')->middleware(['cors']);


Route::get('api/results/{user_id}/all', 'ResultController@allResult');
Route::get('api/problems_analysis/latest', 'ProblemAnalysisController@latestAnalysis');
Route::get('api/problems_analysis/{prob_id}', 'ProblemAnalysisController@getById');

Route::get('api/student_course/{student_id}', 'StudentCourseController@getById');
Route::get('api/course/all', 'CourseController@getAll');
Route::get('api/course/image/{name}', 'CourseController@getCourseImage');
Route::get('api/course/{course_id}/{student_id}', 'CourseController@getDetail');
Route::get('api/lesson/problem/{lesson_id}', 'LessonController@getProblem');
