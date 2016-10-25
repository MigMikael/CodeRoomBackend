/**
 * Created by thanadej on 8/31/2016 AD.
 */

app.factory('studentCourse', function($http) {
    var urlBase = "/api/student_course/";
    var StudentCourseDataOp = {};

    StudentCourseDataOp.getStudentCourse = function (student_code) {
        return $http.get(urlBase+student_code);
    };
    return StudentCourseDataOp;
});