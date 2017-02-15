

app.factory('studentSubmitProblem', function($http) {
    var urlBase = "/api/teacher/problem/";
    var studentSubmitProblem = {};

    studentSubmitProblem.getData = function (token,prob_id) {

        return $http.get(urlBase+prob_id+"/submission",{
            headers:{'Authorization_Token': token}
        });
    };
    return studentSubmitProblem;
});

