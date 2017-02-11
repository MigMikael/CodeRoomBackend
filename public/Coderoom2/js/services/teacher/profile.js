

app.factory('profileTeacher', function($http) {
    var urlBase = "/api/teacher/profile/";
    var profileTeacher = {};

    profileTeacher.getData = function (token,user_id) {
        return $http.get(urlBase+user_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return profileTeacher;
});

