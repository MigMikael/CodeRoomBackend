
app.factory('list_teachersCourse', function($http) {
    var urlBase = "api/";//ยังไม่ได้ทำ
    var list_teacherCourse = {};

    list_teacherCourse.getList_teacherCourse= function (course_id) {
        console.log(urlBase+course_id);
        return $http.get(urlBase+course_id);
    };
    return list_teacherCourse;
});
