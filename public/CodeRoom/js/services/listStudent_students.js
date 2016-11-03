
app.factory('liststudent_student', function($http) {
    var urlBase = "/api/student_course/";//ยังไม่ได้ทำ
    var liststudent_student = {};

    liststudent_student.getListstudent_student = function (student_code) {
        return $http.get(urlBase+student_code);
    };
    return liststudent_student;
});
