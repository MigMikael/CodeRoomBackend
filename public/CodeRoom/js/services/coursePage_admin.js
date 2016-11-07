
app.factory('coursePage_admin', function($http) {
    var urlBase = "/api/admin_course/";
    var coursePage_admin = {};

    coursePage_admin.getCoursePage_admin = function (admin_id,course_id) {
        console.log(urlBase+course_id+"/"+admin_id);
        return $http.get(urlBase+course_id+"/"+admin_id);
    };

    return coursePage_admin;
});
