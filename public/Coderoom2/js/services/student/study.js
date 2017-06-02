
app.factory('studyStudent', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_student_study;
    var studyStudent = {};

    studyStudent.getData = function (token,lesson_id) {

        return $http.get(urlBase+lesson_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return studyStudent;
});

