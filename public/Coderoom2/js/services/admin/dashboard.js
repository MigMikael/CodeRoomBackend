
app.factory('dashBoardAdmin', function($http, Path_Api) {
    var urlBase = Path_Api.api_get_admin_dashboard;
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
