
app.factory('addStudentteacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_addStudent;
    var addStudentteacher = {};

    addStudentteacher.getData = function (token,course_id) {

        return $http.get(urlBase+course_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return addStudentteacher;
});


