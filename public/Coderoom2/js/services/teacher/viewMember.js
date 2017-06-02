

app.factory('viewMemberTeacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_viewMember;
    var viewMemberTeacher = {};

    viewMemberTeacher.getData = function (token,course_id) {

        return $http.get(urlBase+course_id+"/member",{
            headers:{'Authorization_Token': token}
        });
    };
    return viewMemberTeacher;
});

