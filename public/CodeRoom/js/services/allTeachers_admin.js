
app.factory('allTeachers_admin', function($http) {
    var urlBase = "/api/teacher/all";
    var allTeachers_admin = {};

    allTeachers_admin.getAllTeachers_admin = function () {
        return $http.get(urlBase);
    };
    return allTeachers_admin;
});