

app.factory('home', function($http) {
    var urlBase = "/api/user/home";
    var home = {};

    home.getData = function () {

        return $http.get(urlBase);
    };
    return home;
});
