

app.factory('studentSubmitProblem', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_studentSubmit;
    var studentSubmitProblem = {};

    studentSubmitProblem.getData = function (token,prob_id) {

        return $http.get(urlBase+prob_id+"/submission",{
            headers:{'Authorization_Token': token}
        });
    };
    return studentSubmitProblem;
});

