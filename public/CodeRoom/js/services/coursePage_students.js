/**
 * Created by thanadej on 8/31/2016 AD.
 */
app.factory('coursePage_students', function($http) {
    var urlBase = "/api/course/";
    var coursePage_studentsDataOp = {};

    coursePage_studentsDataOp.getcoursePage_students = function (student_id,course_id) {
        console.log(urlBase+course_id+"/"+student_id);
            return $http.get(urlBase+course_id+"/"+student_id);
        };

    return coursePage_studentsDataOp;
});
