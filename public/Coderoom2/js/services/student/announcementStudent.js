

app.factory('announcementStudent', function($http) {
    var urlBase = "/api/student/announcement/";
    var announcementStudent = {};

    announcementStudent.getData = function (token,announcement_id) {

        return $http.get(urlBase+announcement_id,{
            headers:{'Authorization_Token': token}
        });
    };
    return announcementStudent;
});

/**
 * Created by thanadej on 2/11/2017 AD.
 */
