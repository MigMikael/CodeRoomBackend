
app.factory('addStudentteacher', function($http) {
    var urlBase = "/api/teacher/student/all/";
    var addStudentteacher = {};

    addStudentteacher.getData = function (token,course_id) {

        return $http.get(urlBase+course_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return addStudentteacher;
});


