app.factory('teacherCourseAdmin', function($http) {
    var urlBase = "/";
    var teacherCourse = {};

    teacherCourse.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return teacherCourse;
});