

app.factory('announcementTeacher', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_announcement;
    var announcementTeacher = {};

    announcementTeacher.getData = function (token,announcement_id) {

        return $http.get(urlBase+announcement_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return announcementTeacher;
});

