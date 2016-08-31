/**
 * Created by thanadej on 8/31/2016 AD.
 */
app.factory('allcourse', ['$http', function($http) {
    return $http.get('/api/course')
        .success(function(data) {
            return data;
        })
        .error(function(err) {
            return err;
        });
}]);