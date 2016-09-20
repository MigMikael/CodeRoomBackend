/**
 * Created by thanadej on 9/15/2016 AD.
 */
app.factory('getPDFproblem', function($http) {
    var urlBase = "/problemfile/getQuestion/";

    var PDFProblemDataOp = {};

    PDFProblemDataOp.getPDFproblem = function (problem_id) {
        //console.log(urlBase+lesson_id);
        return $http.get(urlBase+problem_id);
    };

    return PDFProblemDataOp;
});