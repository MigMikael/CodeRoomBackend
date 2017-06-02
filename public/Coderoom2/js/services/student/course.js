
app.factory('courseStudent', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_student_course;
    var courseStudent = {};

    courseStudent.getData = function (token,course_id,student_id) {

        return $http.get(urlBase+student_id+"/"+course_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return courseStudent;
});

