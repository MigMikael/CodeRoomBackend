
app.factory('resultProblem', function($http) {
    var urlBase = "/api/student/submission/";
    var resultProblem = {};

    resultProblem.getData = function (token,student_id,problem_id) {

        return $http.get(urlBase+problem_id+"/"+student_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return resultProblem;
});
