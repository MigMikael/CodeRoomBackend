
app.controller('addTeachersinCourse_adminController',function($scope,$stateParams,$http) {



    $scope.teacher_course = {
        course_id: $localStorage.course_id_admin,
    };

    $scope.addTeacherinCourse = function(){
        var res = $http.post('api/teacher/add_one_teacher_member', $scope.teacher_course);

        res.success(function(data, status, headers, config) {
            $scope.message2 = data;

            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };



});
