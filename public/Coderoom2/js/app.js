var app = angular.module("CodeRoom", ["ngRoute","ngStorage","ngFileUpload","ui.ace"]);
app.config(function($routeProvider) {
    $routeProvider
        //student
        .when("/dashboardstudent", {
            templateUrl : "js/views/student/dashBoard.html",
            controller: "dashBoardstudentController"
        })
        .when("/viewcoursestudent/:course_id", {
            templateUrl : "js/views/student/viewCourse.html",
            controller: "viewCourseController"
        })
        .when("/coursestudent/:course_id", {
            templateUrl : "js/views/student/course.html",
            controller: "courseController"
        })
        .when("/studystudent/:lesson_id", {
            templateUrl : "js/views/student/study.html",
            controller: "studyController"
        })
        .when("/viewMemberstudent/:course_id", {
            templateUrl : "js/views/student/viewMember.html",
            controller: "viewMemberController"
        })

        //teacher
        .when("/dashboardteacher", {
            templateUrl : "js/views/teacher/dashBoard.html",
            controller: "dashBoardteacherController"
        })
        .when("/courseteacher", {
            templateUrl : "js/views/teacher/course.html",
            controller: "courseTeacherController"
        })
        .when("/listproblemteacher", {
            templateUrl : "js/views/teacher/listProblem.html",
            controller: "listProblemteacherController"
        })
        .when("/problemteacher", {
            templateUrl : "js/views/teacher/problem.html",
            controller: "problemTeacherController"
        })

        .otherwise({
        redirectTo: '/home',
        templateUrl: 'js/views/home.html',
        controller: 'homeController'
    });
});




