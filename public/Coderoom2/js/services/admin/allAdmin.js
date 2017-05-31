app.factory('allAdmin', function($http) {
    var urlBase = "/";
    var allAdmin = {};

    allAdmin.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return allAdmin;
});