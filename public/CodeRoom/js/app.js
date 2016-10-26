var app = angular.module("CodeRoom", ['ui.router','ngFileUpload','ngStorage']);
app.config(function($stateProvider, $urlRouterProvider) {


    $urlRouterProvider.otherwise('/home');

    $stateProvider
        .state('home', {
            url: '/home',
            controller: "homeController",
            templateUrl: "views/home.html"
        })
        //students
        .state('dashboard_students', {
            url: '/dashboard_students',
            controller: 'dashboard_studentsController',
            templateUrl: 'views/dashboard_students.html'
        })

        .state('coursepage_students', {
            url: '/dashboard_students/:course_name/:course_id',
            controller: "coursePage_studentsController",
            templateUrl: "views/coursepage_students.html",

        })
        .state('coursepage2', {
            url: '/coursepage2',
            templateUrl: "views/coursepage2.html"
        })
        .state('uploadproblme_students', {
            url: '/problem/:course_name/:lesson_id',
            controller: 'uploadproblem_studentsController',
            templateUrl: 'views/uploadproblem_students.html'
        })
        .state('profile_students', {
            url: '/profile',
            controller: 'profileController',
            templateUrl: 'views/profile_students.html'
        })
        .state('uploadproblem', {
            url: '/uploadproblem',
            controller: 'uploadTeacherController',
            templateUrl: 'views/uploadteacher.html'
        })
        //teacher
        .state('dashboard_teachers', {
            url: '/dashboard_teachers',
            controller: 'dashboard_teachersController',
            templateUrl: 'views/dashboard_teachers.html'
        })

        .state('coursepage_teachers', {
            url: '/dashboard_teachers/:course_name/:course_id',
            controller: 'coursePage_teachersController',
            templateUrl: 'views/coursepage_teachers.html'
        })

        .state('addlesson_teachers', {
            url: '/addlesson_teachers/:course_id',
            controller: 'addLesson_teachersController',
            templateUrl: 'views/addLesson_teachers.html'
        })

        .state('addquiz_teachers', {
            url: '/addquiz_teachers/:course_id',
            controller: 'addQuiz_teachersController',
            templateUrl: 'views/addQuiz_teachers.html'
        })

        .state('list_teacherscourse', {
            url: '/list_teachers',
            controller: 'list_teachercourseController',
            templateUrl: 'views/list_teacherscourse.html'
        })

        .state('uploadproblme_teachers', {
            url: '/problem/:course_name/:lesson_id',
            controller: 'uploadproblem_teachersController',
            templateUrl: 'views/uploadproblem_teachers.html'
        });

});



