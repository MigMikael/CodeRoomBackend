
app.factory('viewMember', function($http) {
    var urlBase = "/api/student/course/";
    var viewMember = {};

    viewMember.getData = function (token,course_id) {

        return $http.get(urlBase+course_id+"/member",{
            headers:{'Authorization_Token': token}
        });
    };
    return viewMember;
});

