
app.factory('teacherCourse', function($http) {
    var urlBase = "/api/teacher_course/";
    var teacherCourseDataOp = {};

    teacherCourseDataOp.getteacherCourse = function (teacher_code) {
        return $http.get(urlBase+teacher_code);
    };
    return teacherCourseDataOp;
});/**
 * Created by thanadej on 10/20/2016 AD.
 */
