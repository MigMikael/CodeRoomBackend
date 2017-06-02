
app.factory('dashBoardStudent', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_student_dashboard;
    var dashBoardStudent = {};

    dashBoardStudent.getData = function (token) {

        return $http.get(urlBase,{
            headers:{'Authorization_Token': token}
        });
    };
    return dashBoardStudent;
});
