
app.factory('lesson_teachers', function($http) {
    var urlBase = "api/lesson/problem/";
    var lesson_teachers = {};

    lesson_teachers.getLesson_teachers = function (lesson_id) {
        console.log(urlBase+lesson_id);
        return $http.get(urlBase+lesson_id);
    };
    return lesson_teachers;
});