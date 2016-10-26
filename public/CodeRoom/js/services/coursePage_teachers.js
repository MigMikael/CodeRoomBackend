
app.factory('coursePage_teachers', function($http) {
    var urlBase = "/api/teacher_course/";
    var coursePage_teachersDataOp = {};

    coursePage_teachersDataOp.getCoursePage_teachers = function (teacher_id,course_id) {
        console.log(urlBase+course_id+"/"+teacher_id);
        return $http.get(urlBase+course_id+"/"+teacher_id);
    };

    return coursePage_teachersDataOp;
});
