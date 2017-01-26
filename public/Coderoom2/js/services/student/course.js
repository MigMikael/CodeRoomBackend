
app.factory('courseStudent', function($http) {
    var urlBase = "/api/student/course/";
    var courseStudent = {};

    courseStudent.getData = function (token,course_id) {

        return $http.get(urlBase+course_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return courseStudent;
});

