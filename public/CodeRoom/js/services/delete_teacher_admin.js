app.factory('delete_teacher_admin', function($http) {
    var urlBase = "api/teacher_course/delete/";
    var delete_teacher_admin = {};

    delete_teacher_admin.getDelete_teacher_admin = function (teacher_id, course_id) {
        console.log(urlBase+teacher_id+"/"+course_id);
        return $http.get(urlBase+teacher_id+"/"+course_id);
    };
    return delete_teacher_admin;
});

