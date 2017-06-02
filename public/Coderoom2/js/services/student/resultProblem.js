
app.factory('resultProblem', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_student_submission;
    var resultProblem = {};

    resultProblem.getData = function (token,student_id,problem_id) {

        return $http.get(urlBase+problem_id+"/"+student_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return resultProblem;
});
