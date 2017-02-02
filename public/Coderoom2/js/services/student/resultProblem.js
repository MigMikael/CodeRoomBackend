
app.factory('resultProblem', function($http) {
    var urlBase = "/api/student/problem/";
    var resultProblem = {};

    resultProblem.getData = function (token,student_id,problem_id) {
        console.log(token);
        return $http.get(urlBase+problem_id+"/"+student_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return resultProblem;
});
