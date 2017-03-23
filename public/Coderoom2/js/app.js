var app = angular.module("CodeRoom", ["ngRoute","ngStorage","ngFileUpload","ui.ace",'dndLists','ui.bootstrap','evgenyneu.markdown-preview','angular-svg-round-progressbar']);
app.config(function($routeProvider) {
    $routeProvider

        .when("/login", {
            templateUrl : "js/views/login.html",
            controller: "loginController"
        })
        .when("/register", {
            templateUrl : "js/views/register.html",
            controller: "registerController"
        })

        .when("/selectrole", {
            templateUrl : "js/views/selectRole.html",
            controller: "selectRoleController"
        })

        //student
        .when("/profilestudent", {
            templateUrl : "js/views/student/profile.html",
            controller: "profileStudentController"
        })
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
        .when("/studystudent/:lesson_id/:course_name", {
            templateUrl : "js/views/student/study.html",
            controller: "studyController"
        })
        .when("/viewMemberstudent/:course_id", {
            templateUrl : "js/views/student/viewMember.html",
            controller: "viewMemberController"
        })
        .when("/readannouncementstudent/:announcement_id", {
            templateUrl : "js/views/student/readAnnouncemnet.html",
            controller: "readAnnouncementstudentController"
        })
        .when("/changepasswordstudent", {
            templateUrl : "js/views/student/changePassword.html",
            controller: "changePasswordController"
        })
        .when("/editprofilestudent", {
            templateUrl : "js/views/student/editProfile.html",
            controller: "editProfileController"
        })

        //teacher
        .when("/profileteacher", {
            templateUrl : "js/views/teacher/profile.html",
            controller: "profileTeacherController"
        })
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
        .when("/addstudentsortteacher/:course_id", {
            templateUrl : "js/views/teacher/addStudentSort.html",
            controller: "addStudentSortController"
        })
        .when("/sortlessonteacher/:course_id", {
            templateUrl : "js/views/teacher/sortLesson.html",
            controller: "sortLessonController"
        })
        .when("/sortproblemteacher/:lesson_id", {
            templateUrl : "js/views/teacher/sortProblem.html",
            controller: "sortProblemController"
        })
        .when("/editlessonteacher/:lesson_id", {
            templateUrl : "js/views/teacher/editLesson.html",
            controller: "editLessonteacherController"
        })
        .when("/editproblem/:prob_id", {
            templateUrl : "js/views/teacher/editProblem.html",
            controller: "editProblemteacherController"
        })
        .when("/readannouncementteacher/:announcement_id", {
            templateUrl : "js/views/teacher/readAnnouncement.html",
            controller: "readAnnouncementteacherController"
        })
        .when("/editannouncementteacher/:announcement_id", {
            templateUrl : "js/views/teacher/editAnnouncement.html",
            controller: "editAnnouncementteacherController"
        })
        .when("/uploadstudentlist/:course_id", {
            templateUrl : "js/views/teacher/uploadStudentlist.html",
            controller: "uploadStudentlistController"
        })
        .when("/editprofileteacher", {
            templateUrl : "js/views/teacher/editProfile.html",
            controller: "editProfileTeacherController"
        })
        .when("/changepasswordteacher", {
            templateUrl : "js/views/teacher/changePassword.html",
            controller: "changePasswordTeacherController"
        })

        //admin
        .when("/profileadmin", {
            templateUrl : "js/views/admin/profile.html",
            controller: "profileStudentController"
        })
        .when("/dashboardadmin", {
            templateUrl : "js/views/admin/dashBoard.html",
            controller: "dashboardAdminController"
        })


        .otherwise({
        redirectTo: '/home',
        templateUrl: 'js/views/home.html',
        controller: 'homeController'
    });
});




