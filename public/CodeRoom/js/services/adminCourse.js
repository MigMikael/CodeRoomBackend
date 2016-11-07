
app.factory('adminCourse', function($http) {
    var urlBase = "/api/course/all";
    var adminCourse = {};

    adminCourse.getAdminCourse = function () {
        return $http.get(urlBase);
    };
    return adminCourse;
})
