/**
 * Created by thanadej on 8/31/2016 AD.
 */
app.factory('mycourse', function($http) {
    var urlBase = "/api/course/";
    var MyCourseDataOp = {};

    MyCourseDataOp.getMycourse = function (student_id,course_id) {
        console.log(urlBase+course_id+"/"+student_id);
            return $http.get(urlBase+course_id+"/"+student_id);
        };

    return MyCourseDataOp;
});
