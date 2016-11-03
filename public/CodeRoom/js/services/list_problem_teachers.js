

app.factory('list_problems_teacher', function($http) {
    var urlBase = "api/lesson/problem/";
    var list_problems_teacher = {};

    list_problems_teacher.getList_problems_teacher= function (lesson_id) {
        console.log(urlBase+lesson_id);
        return $http.get(urlBase+lesson_id);
    };
    return list_problems_teacher;
});
