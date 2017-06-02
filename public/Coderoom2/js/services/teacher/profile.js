

app.factory('profileTeacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_profile;
    var profileTeacher = {};

    profileTeacher.getData = function (token,user_id) {
        return $http.get(urlBase+user_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return profileTeacher;
});

