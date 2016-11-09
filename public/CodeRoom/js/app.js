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
            controller: 'profile_studentsController',
            templateUrl: 'views/profile_students.html'
        })

        .state('liststudent_students', {
            url: '/liststudent_students',
            controller: 'liststudent_studentsController',
            templateUrl: 'views/listStudent_student.html'
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
            url: '/list_teachers/:course_id',
            controller: 'list_teachercourseController',
            templateUrl: 'views/list_teacherscourse.html'
        })

        .state('list_problems_teacher', {
            url: '/list_problems_teacher/:lesson_id',
            controller: 'list_problems_teachercourseController',
            templateUrl: 'views/list_problems_teachers.html'
        })

        .state('addproblem_teachers', {
            url: '/addproblem_teachers',
            controller: 'addproblem_teachersController',
            templateUrl: 'views/addproblem_teachers.html'
        })

        .state('addstudents_teachers', {
            url: '/addstudents_teachers',
            controller: 'addstudents_teachersController',
            templateUrl: 'views/addStudents_teachers.html'
        })
        .state('liststudent_teachers', {
            url: '/liststudent_teachers',
            controller: 'liststudent_teachersController',
            templateUrl: 'views/listStudent_teachers.html'
        })


    //admin
        .state('dashboard_admin', {
            url: '/dashboard_admin',
            controller: 'dashboard_adminController',
            templateUrl: 'views/dashboard_admin.html'
        })
        .state('coursepage_admin', {
            url: '/coursepage_admin/:course_id',
            controller: 'coursePage_adminController',
            templateUrl: 'views/coursepage_admin.html'
        })
        .state('addteachersinCourse_admin', {
            url: '/addteachersinCourse_admin',
            controller: 'addTeachersinCourse_adminController',
            templateUrl: 'views/addTeachers_admin.html'
        })
        .state('addteachers_admin', {
            url: '/addteachers_admin',
            controller: 'addTeachers_adminController',
            templateUrl: 'views/addTeachers_admin.html'
        })
    ;

});



