

app.factory('viewCodeSubmit', function($http) {
    var urlBase = "/api/teacher/submission/";
    var viewCodeSubmit = {};

    viewCodeSubmit.getData = function (token,submit_id) {

        return $http.get(urlBase+submit_id+"/code",{
            headers:{'Authorization_Token': token}
        });
    };
    return viewCodeSubmit;
});

