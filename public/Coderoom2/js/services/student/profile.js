
app.factory('profileStudent', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_student_profile;
    var profileStudent = {};

    profileStudent.getData = function (token,user_id) {
        return $http.get(urlBase+user_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return profileStudent;
});
