
app.factory('courseTeacher', function($http) {
    var urlBase = "/api/teacher/course/";
    var courseTeacher = {};

    courseTeacher.getData = function (token,course_id) {

        return $http.get(urlBase+course_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return courseTeacher;
});

/**
 * Created by thanadej on 2/2/2017 AD.
 */
