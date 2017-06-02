
app.factory('lessonTeacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_lesson;
    var lessonTeacher = {};

    lessonTeacher.getData = function (token,lesson_id) {

        return $http.get(urlBase+lesson_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return lessonTeacher;
});

