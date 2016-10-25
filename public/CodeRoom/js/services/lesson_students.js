/**
 * Created by thanadej on 9/8/2016 AD.
 */
app.factory('lesson_students', function($http) {
    var urlBase = "api/lesson/problem/";
    var lesson_studentsDataOp = {};

    lesson_studentsDataOp.getlesson_students = function (lesson_id) {
        console.log(urlBase+lesson_id);
        return $http.get(urlBase+lesson_id);
    };
    return lesson_studentsDataOp;
});
