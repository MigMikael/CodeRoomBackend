
app.factory('list_teachersCourse', function($http) {
    var urlBase = "api/course/teacher_member/";
    var list_teacherCourse = {};

    list_teacherCourse.getList_teacherCourse= function (course_id) {
        console.log(urlBase+course_id);
        return $http.get(urlBase+course_id);
    };
    return list_teacherCourse;
});
