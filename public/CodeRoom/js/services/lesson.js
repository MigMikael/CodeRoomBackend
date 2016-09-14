/**
 * Created by thanadej on 9/8/2016 AD.
 */
app.factory('lesson', function($http) {
    var urlBase = "api/lesson/problem/";//แก้พาท
    var LessonDataOp = {};

    LessonDataOp.getLesson = function (lesson_id) {
        //console.log(urlBase+lesson_id);
        return $http.get(urlBase+lesson_id);
    };

    return LessonDataOp;
});
