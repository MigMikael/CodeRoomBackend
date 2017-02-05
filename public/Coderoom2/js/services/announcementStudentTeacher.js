

app.factory('announcementStudentTeacher', function($http) {
    var urlBase = "/api/teacher/announcement/";
    var announcementStudentTeacher = {};

    announcementStudentTeacher.getData = function (token,announcement_id) {

        return $http.get(urlBase+announcement_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return announcementStudentTeacher;
});

