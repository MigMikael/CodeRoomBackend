/**
 * Created by thanadej on 9/8/2016 AD.
 */
app.factory('lesson', function($http) {
    var urlBase = "";//แก้พาท
    var LessonDataOp = {};

    LessonDataOp.getLesson = function (course_id) {
        console.log(urlBase+course_id);
        return $http.get(urlBase+course_id);
    };

    return LessonDataOp;
});
