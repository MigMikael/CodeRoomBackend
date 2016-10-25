/**
 * Created by thanadej on 8/31/2016 AD.
 */

app.factory('allCourse_students', function($http) {
    var urlBase = "/api/course/all";
    var allCourse_studentsDataOp = {};

    allCourse_studentsDataOp.getallCourse_students = function () {
        return $http.get(urlBase);
    };
    return allCourse_studentsDataOp;
});