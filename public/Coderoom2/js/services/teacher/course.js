
app.factory('courseTeacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_course;
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
