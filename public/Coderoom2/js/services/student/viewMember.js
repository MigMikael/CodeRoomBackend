
app.factory('viewMember', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_student_viewMember;
    var viewMember = {};

    viewMember.getData = function (token,course_id) {

        return $http.get(urlBase+course_id+"/member",{
            headers:{'Authorization_Token': token}
        });
    };
    return viewMember;
});

