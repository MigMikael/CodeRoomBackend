

app.factory('viewCodeSubmit', function($http,Path_Api) {
    var urlBase = Path_Api.api_get_teacher_viewCodeSubmit;
    var viewCodeSubmit = {};

    viewCodeSubmit.getData = function (token,submit_id) {

        return $http.get(urlBase+submit_id+"/code",{
            headers:{'Authorization_Token': token}
        });
    };
    return viewCodeSubmit;
});

