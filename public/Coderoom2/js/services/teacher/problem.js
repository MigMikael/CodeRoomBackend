
app.factory('problemTeacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_problem;
    var problemTeacher = {};

    problemTeacher.getData = function (token,prob_id) {

        return $http.get(urlBase+prob_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return problemTeacher;
});

