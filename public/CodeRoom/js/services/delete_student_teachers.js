app.factory('delete_student_teachers', function($http) {
    var urlBase = "api/student_course/delete/";
    var delete_student_teachers = {};

    delete_student_teachers.getDelete_student_teachers = function (student_id, course_id) {
        console.log(urlBase+student_id+"/"+course_id);
        return $http.get(urlBase+student_id+"/"+course_id);
    };
    return delete_student_teachers;
});
