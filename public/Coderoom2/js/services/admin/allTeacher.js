app.factory('allTeacherAdmin', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_admin_allTeacher;
    var allTeacherAdmin = {};

    allTeacherAdmin.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return allTeacherAdmin;
});