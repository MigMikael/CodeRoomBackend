var app = angular.module("CodeRoom", ["ngRoute","ngStorage","ngFileUpload","ui.ace",'dndLists']);
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
        .when("/courseteacher/:course_id", {
            templateUrl : "js/views/teacher/course.html",
            controller: "courseTeacherController"
        })
        .when("/listproblemteacher/:lesson_id", {
            templateUrl : "js/views/teacher/listProblem.html",
            controller: "listProblemteacherController"
        })
        .when("/problemteacher/:prob_id", {
            templateUrl : "js/views/teacher/problem.html",
            controller: "problemTeacherController"
        })
        .when("/viewMemberteacher/:course_id", {
            templateUrl : "js/views/teacher/viewMember.html",
            controller: "viewMemberteacherController"
        })
        .when("/addlessonteacher/:course_id", {
            templateUrl : "js/views/teacher/addLesson.html",
            controller: "addLessonteacherController"
        })
        .when("/addproblemteacher/:lesson_id", {
            templateUrl : "js/views/teacher/addProblem.html",
            controller: "addProblemteacherController"
        })
        .when("/addannouncementteacher/:course_id", {
            templateUrl : "js/views/teacher/addAnnouncement.html",
            controller: "addAnnouncementteacherController"
        })
        .when("/addstudentsortteacher", {
            templateUrl : "js/views/teacher/addStudentSort.html",
            controller: "addStudentSortController"
        })
        .when("/sortlessonteacher/:course_id", {
            templateUrl : "js/views/teacher/sortLesson.html",
            controller: "sortLessonController"
        })
        .when("/editlessonteacher/:lesson_id", {
            templateUrl : "js/views/teacher/editLesson.html",
            controller: "editLessonteacherController"
        })
        .when("/editproblem/:prob_id", {
            templateUrl : "js/views/teacher/editProblem.html",
            controller: "editProblemteacherController"
        })



        .otherwise({
        redirectTo: '/home',
        templateUrl: 'js/views/home.html',
        controller: 'homeController'
    });
});




