
app.factory('liststudent_student', function($http) {
    var urlBase = "/api/student_course/";//ยังไม่ได้ทำ
    var liststudent_student = {};

    liststudent_student.getListstudent_student = function (course_id) {
        return $http.get(urlBase+course_id);
    };
    return liststudent_student;
});
