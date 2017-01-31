var app = angular.module("CodeRoom", ["ngRoute","ngStorage","ngFileUpload","ui.ace"]);
app.config(function($routeProvider) {
    $routeProvider


        .when("/selectrole", {
            templateUrl : "js/views/selectRole.html",
            controller: "selectRoleController"
        })
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
        .when("/viewMemberteacher", {
            templateUrl : "js/views/teacher/viewMember.html",
            controller: "viewMemberteacherController"
        })
        .when("/addlessonteacher", {
            templateUrl : "js/views/teacher/addLesson.html",
            controller: "addLessonteacherController"
        })
        .when("/addproblemteacher", {
            templateUrl : "js/views/teacher/addProblem.html",
            controller: "addProblemteacherController"
        })
        .when("/addannouncement", {
            templateUrl : "js/views/teacher/addAnnouncement.html",
            controller: "addAnnouncementteacherController"
        })



        .otherwise({
        redirectTo: '/home',
        templateUrl: 'js/views/home.html',
        controller: 'homeController'
    });
});




