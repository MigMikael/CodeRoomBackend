app.factory('delete_teacher_admin', function($http) {
    var urlBase = "api/student_course/delete/"; //todo ยังไม่ได้ใส่พาท
    var delete_teacher_admin = {};

    delete_teacher_admin.getDelete_teacher_admin = function (teacher_id, course_id) {
        console.log(urlBase+teacher_id+"/"+course_id);
        return $http.get(urlBase+teacher_id+"/"+course_id);
    };
    return delete_teacher_admin;
});

