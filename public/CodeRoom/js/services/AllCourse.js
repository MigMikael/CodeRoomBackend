/**
 * Created by thanadej on 8/31/2016 AD.
 */

app.factory('allcourse', function($http) {
    var urlBase = "/api/course/all";
    var AllCourseDataOp = {};

    AllCourseDataOp.getAllCourse = function () {
        return $http.get(urlBase);
    };
    return AllCourseDataOp;
});