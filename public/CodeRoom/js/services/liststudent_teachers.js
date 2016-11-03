
app.factory('liststudent_teachers', function($http) {
    var urlBase = "api/course/student_member/";
    var liststudent_teacher = {};

    liststudent_teacher.getListstudent_teacher = function (course_id) {
        return $http.get(urlBase+course_id);
    };
    return liststudent_teacher;
});