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
        .when("/addcourseadmin", {
            templateUrl : "js/views/admin/addCourse.html",
            controller: "addCourseAdminController"
        })
        .when("/createteacheradmin", {
            templateUrl : "js/views/admin/createTeacher.html",
            controller: "createTeacherAdminController"
        })
        .when("/createadmin", {
            templateUrl : "js/views/admin/createAdmin.html",
            controller: "createAdminController"
        })
        .when("/addteachercourseadmin/:course_id", {
            templateUrl : "js/views/admin/addTeacherCourse.html",
            controller: "addTeacherCourseAdminController"
        })

        .otherwise({
        redirectTo: '/home',
        templateUrl: 'js/views/home.html',
        controller: 'homeController'
    });
});
app.factory('Path_Api', function() {
    return {
        api_login: "/login",
        api_logout: "/logout",
        //student
        api_get_student_announcement: "/api/student/announcement/",
        api_get_student_course: "/api/student/course/",
        api_get_student_dashboard: "/api/student/dashboard",
        api_get_student_profile: "/api/student/profile/",
        api_get_student_submission: "/api/student/submission/",
        api_get_student_study : "/api/student/lesson/",
        api_get_student_viewMember : "/api/student/course/",

        api_post_student_changePassword : "/api/student/change_password",
        api_post_student_editProfile : "/api/student/profile/edit",
        api_post_student_submission : "/api/student/submission",
        //teacher
        api_get_teacher_addStudent : "/api/teacher/student/all/",
        api_get_teacher_announcement : "/api/teacher/announcement/",
        api_get_teacher_course : "/api/teacher/course/",
        api_get_teacher_dashboard : "/api/teacher/dashboard",
        api_get_teacher_lesson : "/api/teacher/lesson/",
        api_get_teacher_problem : "/api/teacher/problem/",
        api_get_teacher_profile : "/api/teacher/profile/",
        api_get_teacher_studentSubmit : "/api/teacher/problem/",
        api_get_teacher_viewCodeSubmit : "/api/teacher/submission/",
        api_get_teacher_viewMember : "/api/teacher/course/",

        api_post_teacher_addAnnouncement : '/api/teacher/announcement/store',
        api_post_teacher_addLesson : '/api/teacher/lesson/store',
        api_post_teacher_addProblem : '/api/teacher/problem/store',
        api_post_teacher_addScoreProblem : '/api/teacher/problem/store_score',
        api_post_teacher_changePassword : '/api/teacher/change_password',
        api_post_teacher_editAnnoucement : '/api/teacher/announcement/edit',
        api_post_teacher_editLesson : '/api/teacher/lesson/edit',
        api_post_teacher_editProblem : '/api/teacher/problem/edit',
        api_post_teacher_editProfile : '/api/teacher/profile/edit',



        api_delete_teacher_deleteLesson : '/api/teacher/lesson/delete/',
        api_delete_teacher_announcement : '/api/teacher/announcement/delete/',
        api_delete_teacher_deleteProblem : '/api/teacher/problem/delete/',




    };
});




