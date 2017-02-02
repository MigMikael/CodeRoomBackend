

app.factory('viewMemberTeacher', function($http) {
    var urlBase = "/api/teacher/course/";
    var viewMemberTeacher = {};

    viewMemberTeacher.getData = function (token,course_id) {

        return $http.get(urlBase+course_id+"/member",{
            headers:{'Authorization_Token': token}
        });
    };
    return viewMemberTeacher;
});

