
app.factory('courseStudent', function($http) {
    var urlBase = "/api/student/course/";
    var courseStudent = {};

    courseStudent.getData = function (token,course_id,student_id) {

        return $http.get(urlBase+student_id+"/"+course_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return courseStudent;
});

