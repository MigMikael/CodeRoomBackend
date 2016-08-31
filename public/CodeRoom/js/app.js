var app = angular.module("CodeRoom", ['ngRoute','ngFileUpload','ui.ace']);
app.config(function ($routeProvider) {
    $routeProvider
        .when('/home',{
            controller: "homeController",
            templateUrl: "views/home.html"
        })
        .when('/coursepage', {
            controller: "coursePageController",
            templateUrl: "views/coursepage.html"
        })
        .when('/coursepage2', {
            templateUrl: "views/coursepage2.html"
        })
        .when('/students', {
            controller: 'studentController',
            templateUrl: 'views/students.html'
        })
        .when('/upload',{
            controller: 'uploadController',
            templateUrl: 'views/upload.html'
        })
        .when('/profile',{
            controller: 'profileController',
            templateUrl: 'views/profile.html'
        })
        .when('/teacheruploadproblem',{
            controller: 'uploadTeacherController',
            templateUrl: 'views/uploadteacher.html'
        })
        .otherwise({
            redirectTo: '/home'
        });

});
