app.factory('allTeacherAdmin', function($http) {
    var urlBase = "/";
    var allTeacherAdmin = {};

    allTeacherAdmin.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return allTeacherAdmin;
});