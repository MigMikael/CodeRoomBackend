
app.factory('dashBoardAdmin', function($http) {
    var urlBase = "/api/admin/dashboard";
    var dashBoardAdmin = {};

    dashBoardAdmin.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return dashBoardAdmin;
});

/**
 * Created by thanadej on 2/4/2017 AD.
 */
