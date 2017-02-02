
app.factory('problemTeacher', function($http) {
    var urlBase = "/api/teacher/problem/";
    var problemTeacher = {};

    problemTeacher.getData = function (token,prob_id) {

        return $http.get(urlBase+prob_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return problemTeacher;
});

