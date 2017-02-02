
app.factory('dashboardTeacher', function($http) {
    var urlBase = "/api/teacher/dashboard";
    var dashboardTeacher = {};

    dashboardTeacher.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return dashboardTeacher;
});

