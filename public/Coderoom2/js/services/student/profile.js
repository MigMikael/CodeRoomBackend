
app.factory('profileStudent', function($http) {
    var urlBase = "/api/student/profile/";
    var profileStudent = {};

    profileStudent.getData = function (token,user_id) {

        return $http.get(urlBase+user_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return profileStudent;
});
