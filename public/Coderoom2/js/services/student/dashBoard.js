
app.factory('dashBoardStudent', function($http) {
    var urlBase = "/api/student/dashboard";
    var dashBoardStudent = {};

    dashBoardStudent.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return dashBoardStudent;
});
