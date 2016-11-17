/**
 * Created by thanadej on 8/31/2016 AD.
 */

app.factory('allStudent', function($http) {
    var urlBase = "/student";
    var allStudent = {};

    allStudent.getAllStudent = function () {
        return $http.get(urlBase);
    };
    return allStudent;
});