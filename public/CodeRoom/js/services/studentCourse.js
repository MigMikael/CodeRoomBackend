/**
 * Created by thanadej on 8/31/2016 AD.
 */
app.factory('studentcourse', ['$http', function($http) {
    return $http.get('/api/student_course/07560550')
        .success(function(data) {
            return data;
        })
        .error(function(err) {
            return err;
        });
}]);