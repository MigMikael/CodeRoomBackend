
app.factory('profile_students', function($http) {
    var urlBase = "/api/student/profile/";
    var profile_students = {};

    profile_students.getProfile_students = function (student_code) {
        return $http.get(urlBase+student_code);
    };
    return profile_students;
});