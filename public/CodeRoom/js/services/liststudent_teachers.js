
app.factory('liststudent_teachers', function($http) {
    var urlBase = "/api/student_course/";//ยังไม่ได้ทำ
    var liststudent_teacher = {};

    liststudent_teacher.getListstudent_teacher = function (course_id) {
        return $http.get(urlBase+course_id);
    };
    return liststudent_teacher;
});