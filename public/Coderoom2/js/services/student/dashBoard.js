
app.factory('dashBoardStudent', function($http) {
    var urlBase = "/api/dashboard/student";
    var dashBoardStudent = {};

    dashBoardStudent.getData = function (token) {
        console.log(token);
        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return dashBoardStudent;
});
