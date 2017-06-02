
app.factory('dashboardTeacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_dashboard;
    var dashboardTeacher = {};

    dashboardTeacher.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return dashboardTeacher;
});

