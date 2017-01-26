
app.factory('studyStudent', function($http) {
    var urlBase = "/api/student/lesson/";
    var studyStudent = {};

    studyStudent.getData = function (token,lesson_id) {

        return $http.get(urlBase+lesson_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return studyStudent;
});

