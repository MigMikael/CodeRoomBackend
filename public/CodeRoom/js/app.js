var app = angular.module("CodeRoom", ['ui.router','ngFileUpload','ngStorage']);
app.config(function($stateProvider, $urlRouterProvider) {


    $urlRouterProvider.otherwise('/home');

    $stateProvider
        .state('home', {
            url: '/home',
            controller: "homeController",
            templateUrl: "views/home.html"
        })
        .state('dashboard', {
            url: '/dashboard',
            controller: 'dashboardController',
            templateUrl: 'views/dashboard.html'
        })
        .state('course', {
            url: '/:course_name/:course_id',
            controller: "coursePageController",
            templateUrl: "views/coursepage.html",

        })
        .state('coursepage2', {
            url: '/coursepage2',
            templateUrl: "views/coursepage2.html"
        })

        .state('problem', {
            url: '/problem/:course_name/:lesson_id',
            controller: 'uploadController',
            templateUrl: 'views/upload.html'
        })


        .state('/profile', {
            url: '/profile',
            controller: 'profileController',
            templateUrl: 'views/profile.html'
        })
        .state('uploadproblem', {
            url: '/uploadproblem',
            controller: 'uploadTeacherController',
            templateUrl: 'views/uploadteacher.html'
        });

});



