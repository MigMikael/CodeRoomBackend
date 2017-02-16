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

#--------------------------------------------------------------------------------------------------------
#
#
#                              Internal API
#
#
#--------------------------------------------------------------------------------------------------------
#                              Route resource
#--------------------------------------------------------------------------------------------------------
Route::resource('problem', 'ProblemController');
Route::resource('badge', 'BadgeController');
Route::resource('badge_student', 'BadgeStudentController');
Route::resource('problem_analysis', 'ProblemAnalysisController');
Route::resource('course', 'CourseController');
Route::resource('lesson', 'LessonController');
Route::resource('submission', 'SubmissionController');
Route::resource('submissionfile', 'SubmissionFileController');
Route::resource('results', 'ResultController');
Route::resource('student', 'StudentController');
Route::resource('student_course', 'StudentCourseController');
Route::resource('teacher', 'TeacherController');
Route::resource('teacher_course', 'TeacherCourseController');
Route::resource('announcement', 'AnnouncementController');


Route::post('submissionfile2', 'SubmissionFileController@store2');
#--------------------------------------------------------------------------------------------------------
#                              Student API
#--------------------------------------------------------------------------------------------------------
Route::get('course/{course}/status', 'CourseController@changeStatus');
Route::get('student_course/{student_id}/{course_id}/status', 'StudentController@changeStatus');
Route::get('student_badge/{student_id}/{badge_id}/delete', 'StudentController@deleteBadge');
Route::get('teacher_course/{teacher_id}/{course_id}/status', 'TeacherController@changeStatus');


#--------------------------------------------------------------------------------------------------------
#                              ProblemFile API
#--------------------------------------------------------------------------------------------------------
Route::get('problemfile', 'ProblemFileController@index');
//Route::get('problemfile/create', 'ProblemFileController@create');
Route::get('problemfile/get/{filename}', ['as' => 'getfile', 'uses' => 'ProblemFileController@get']);
Route::post('problemfile/add', ['as' => 'addfile', 'uses' => 'ProblemFileController@add']);
Route::post('problemfile/edit', ['as' => 'editfile', 'uses' => 'ProblemFileController@edit']);
Route::get('problem/getQuestion/{problem_id}', 'ProblemController@getQuestion');


#--------------------------------------------------------------------------------------------------------
#                              Test API
#--------------------------------------------------------------------------------------------------------
#Route::get('test', 'TestController@index');
#Route::get('test/file/{folderName}', 'TestController@getFile');
#Route::get('test/string_pos', 'TestController@testStrPos');
#Route::get('test/template2', 'TestController@testTemplate2');
#Route::get('test/token', 'TestController@testToken');
#Route::get('test/current_user_profile','TestController@getUserProfile');
#Route::get('test/getQuestion', 'TestController@testGetQuestion');
Route::get('test/count', 'TestController@testCount');
Route::get('test/order_problem', 'TestController@testProblemOrder');

#--------------------------------------------------------------------------------------------------------
#                              Image API
#--------------------------------------------------------------------------------------------------------
Route::get('image/gen_user_avatar_image', 'ImageController@genAvatarImage');
Route::get('image/{id}', 'ImageController@getImage');


#--------------------------------------------------------------------------------------------------------
#
#
#                               Web Submission API
#
#
#--------------------------------------------------------------------------------------------------------
#                               General API
#--------------------------------------------------------------------------------------------------------
Route::post('login', 'UserAuthController@loginUser');
Route::get('login', 'UserAuthController@login');
Route::get('logout', 'UserAuthController@logout');

Route::post('register', 'UserAuthController@registerUser');
Route::get('register', 'UserAuthController@register');

Route::get('api/user/home', 'CourseController@showCourseUser');


#--------------------------------------------------------------------------------------------------------
#                               Student API
#--------------------------------------------------------------------------------------------------------

Route::group(['middleware' => ['userAuth', 'studentAuth']], function (){

    Route::get('api/student/dashboard', 'StudentController@dashboard');

    Route::get('api/student/profile/{id}', 'StudentController@getProfile');
    // new
    Route::post('api/student/profile/edit', 'StudentController@updateProfile');

    Route::post('api/student/change_password', 'StudentController@changePassword');

    Route::get('api/student/course/{id}/member', 'CourseController@getMember');

    Route::get('api/student/course/{student_id}/{course_id}', 'CourseController@showCourseStudent');

    Route::get('api/student/lesson/{id}', 'LessonController@showLesson');

    Route::get('api/student/announcement/{id}', 'AnnouncementController@showAnnouncement');

    Route::get('api/student/submission/{problem_id}/{student_id}', 'SubmissionController@getResult');

    Route::post('api/student/submission', 'SubmissionController@store2');

});


#--------------------------------------------------------------------------------------------------------
#                               Teacher API
#--------------------------------------------------------------------------------------------------------
//Route::group(['middleware' => ['userAuth', 'teacherAuth']], function (){

    Route::get('api/teacher/dashboard', 'TeacherController@dashboard');
    Route::get('api/teacher/profile/{id}', 'TeacherController@getProfile');
    Route::post('api/teacher/profile/edit', 'TeacherController@updateProfile');
    Route::post('api/teacher/change_password', 'TeacherController@changePassword');

    Route::get('api/teacher/course/{course_id}', 'CourseController@showCourseTeacher');
    Route::get('api/teacher/course/{id}/member', 'CourseController@getMember');

    Route::get('api/teacher/lesson/{id}', 'LessonController@showLesson');               //  show
    Route::post('api/teacher/lesson/edit', 'LessonController@updateLesson');            //  update
    Route::post('api/teacher/lesson/store', 'LessonController@storeLesson');            //  store
    Route::delete('api/teacher/lesson/delete/{id}', 'LessonController@deleteLesson');   //  delete
    Route::post('api/teacher/lesson/change_order', 'LessonController@changeLessonOrder');

    Route::get('api/teacher/problem/{id}', 'ProblemController@showProblem');                //  show
    // Todo fix edit problem (method)
    Route::post('api/teacher/problem/edit', 'ProblemController@updateProblem');             //  update
    Route::post('api/teacher/problem/store', 'ProblemController@storeProblem');             //  store
    Route::delete('api/teacher/problem/delete/{id}', 'ProblemController@deleteProblem');    //  delete
    Route::post('api/teacher/problem/change_order', 'ProblemController@changeProblemOrder');
    Route::get('api/teacher/problem/{id}/submission', 'ProblemController@getProblemSubmission');

    Route::get('api/teacher/submission/{id}/code', 'SubmissionController@getSubmissionCode');

    Route::get('api/teacher/announcement/{id}', 'AnnouncementController@showAnnouncement');             //  show
    Route::post('api/teacher/announcement/edit', 'AnnouncementController@updateAnnouncement');          //  update
    Route::post('api/teacher/announcement/store', 'AnnouncementController@storeAnnouncement');          //  store
    Route::delete('api/teacher/announcement/delete/{id}', 'AnnouncementController@deleteAnnouncement'); //  delete

    Route::get('api/teacher/student/{id}', 'StudentController@showStudent');                                    //  show
    Route::post('api/teacher/student/store', 'StudentController@addStudentMember');                             //  store One
    Route::post('api/teacher/students/store', 'StudentController@addStudentsMember');                           //  store Many
    Route::get('api/teacher/student/disable/{student_id}/{course_id}', 'StudentController@disableStudent');     // deactivate
    Route::get('api/teacher/student/all/{course_id}', 'StudentController@getAll');

//});


#--------------------------------------------------------------------------------------------------------
#                               Image API
#--------------------------------------------------------------------------------------------------------
Route::get('api/image/{id}', 'ImageController@getImage');
Route::get('api/course/image/{name}', 'CourseController@getCourseImage');


#--------------------------------------------------------------------------------------------------------
#
#
#                              Waiting for deprecate
#
#
#--------------------------------------------------------------------------------------------------------
Route::get('api/results/{user_id}/latest', 'ResultController@latestResult')->middleware(['cors']);
Route::get('api/results/{user_id}/all', 'ResultController@allResult');
Route::post('problem_analysis/score', 'ProblemAnalysisController@keepScore');
//Route::get('api/problems_analysis/latest', 'ProblemAnalysisController@latestAnalysis');
Route::get('api/problems_analysis/{prob_id}', 'ProblemAnalysisController@getById');

Route::get('api/course/all', 'CourseController@getAll')->middleware(['userAuth']);

Route::get('api/student_course/{course_id}/{student_id}', 'CourseController@getDetailStudent');
Route::get('api/teacher_course/{course_id}/{teacher_id}', 'CourseController@getDetailTeacher');
Route::get('api/admin_course/{course_id}/{admin_id}', 'CourseController@getDetailAdmin');
Route::get('api/lesson/problem/{lesson_id}', 'LessonController@getProblem');
Route::get('api/course/student_member/{course_id}','CourseController@getStudentMember');
Route::get('api/course/teacher_member/{course_id}','CourseController@getTeacherMember');
Route::get('api/course/add_student_member', 'CourseController@addStudentMember');
Route::get('api/course/add_teacher_member', 'CourseController@addTeacherMember');

Route::get('api/student/profile/{student_id}', 'StudentController@getStudentProfile');
Route::post('api/student/add_one_student_member', 'StudentController@addStudentMember');
Route::post('api/student/add_many_student_member', 'StudentController@addStudentsMember');
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

//api for submission
Route::post('api/submission/code', 'SubmissionController@storeCode');

//api deprecated
Route::get('api/teacher_course/{teacher_id}', 'TeacherCourseController@getById');


