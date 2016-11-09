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
Route::resource('badge', 'badgeController');
Route::resource('problem_analysis', 'ProblemAnalysisController');
Route::resource('course', 'CourseController');
Route::resource('lesson', 'LessonController');
Route::resource('submissions', 'SubmissionController');
Route::resource('results', 'ResultController');
Route::resource('student', 'StudentController');
Route::resource('student_course', 'StudentCourseController');
Route::resource('teacher', 'TeacherController');
Route::resource('teacher_course', 'TeacherCourseController');
Route::resource('announcement', 'AnnouncementController');


Route::get('problemfile', 'ProblemFileController@index');
Route::get('problemfile/create', 'ProblemFileController@create');
Route::get('problemfile/get/{filename}', ['as' => 'getfile', 'uses' => 'ProblemFileController@get']);
Route::post('problemfile/add', ['as' => 'addfile', 'uses' => 'ProblemFileController@add']);
Route::get('problemfile/getQuestion/{prob_id}', 'ProblemFileController@getQuestion');


Route::get('api/results/{user_id}/latest', 'ResultController@latestResult')->middleware(['cors']);
Route::get('api/results/{user_id}/all', 'ResultController@allResult');


Route::post('problem_analysis/score', 'ProblemAnalysisController@keepScore');
Route::get('api/problems_analysis/latest', 'ProblemAnalysisController@latestAnalysis');
Route::get('api/problems_analysis/{prob_id}', 'ProblemAnalysisController@getById');


Route::get('api/course/all', 'CourseController@getAll');
Route::get('api/course/image/{name}', 'CourseController@getCourseImage');
Route::get('api/student_course/{course_id}/{student_id}', 'CourseController@getDetailStudent');
Route::get('api/teacher_course/{course_id}/{teacher_id}', 'CourseController@getDetailTeacher');
Route::get('api/admin_course/{course_id}/{admin_id}', 'CourseController@getDetailAdmin');
Route::get('api/lesson/problem/{lesson_id}', 'LessonController@getProblem');
Route::get('api/course/student_member/{course_id}','CourseController@getStudentMember');
Route::get('api/course/teacher_member/{course_id}','CourseController@getTeacherMember');
Route::get('api/course/add_student_member', 'CourseController@addStudentMember');
Route::get('api/course/add_teacher_member', 'CourseController@addTeacherMember');


Route::get('api/student/profile/{student_id}', 'StudentController@getStudentProfile');
Route::post('api/student/add_one_student_member', 'StudentController@storeOneStudentMember');
Route::post('api/student/add_many_student_member', 'StudentController@storeManyStudentMember');

Route::get('api/student_course/{student_id}', 'StudentCourseController@getById');
Route::get('api/student_course/delete/{student_id}/{course_id}', 'StudentCourseController@destroyById');

Route::get('api/teacher/all', 'TeacherController@getAll');
Route::post('api/teacher/add_one_teacher_member', 'TeacherController@storeOneTeacherMember');

Route::get('api/teacher_course/delete/{teacher_id}/{course_id}', 'TeacherCourseController@destroyById');

//api for badge achievement
Route::get('api/student_badge/{student_id}', 'StudentController@getBadge');
Route::get('api/badge_student/{badge_id}', 'BadgeController@getStudent');
Route::get('api/course_badge/{course_id}', 'CourseController@getBadge');
Route::post('api/gen_lesson_badge', 'BadgeController@genLessonBadge');

// api for generate image
Route::get('api/image/gen_lesson_badge_image/{course_name}/{lesson_name}/{color}', 'ImageController@genLessonBadgeImage');
Route::get('api/image/gen_normal_badge_image/{course_name}/{criteria}/{color}', 'ImageController@genNormalBadgeImage');
Route::get('api/image/gen_user_avatar_image', 'ImageController@genAvatarImage');
Route::get('api/image/{id}', 'ImageController@getImage');

//api for test
Route::get('test', 'TestController@index');

//api deprecated
Route::get('api/teacher_course/{teacher_id}', 'TeacherCourseController@getById');