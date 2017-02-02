
app.factory('lessonTeacher', function($http) {
    var urlBase = "/api/teacher/lesson/";
    var lessonTeacher = {};

    lessonTeacher.getData = function (token,lesson_id) {

        return $http.get(urlBase+lesson_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return lessonTeacher;
});

