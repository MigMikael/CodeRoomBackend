/**
 * Created by thanadej on 9/15/2016 AD.
 */
app.factory('getimageproblem', function($http) {
    var urlBase = "";
    var imageProblemDataOp = {};

    imageProblemDataOp.getImageproblem = function (problem_id) {
        //console.log(urlBase+lesson_id);
        return $http.get(urlBase+problem_id);
    };

    return imageProblemDataOp;
});