
app.controller('addTeachers_adminController',function($scope,$stateParams,$http) {



    $scope.teacher = {

    };

    $scope.addTeacher = function(){
        var res = $http.post('api/teacher/add_one_teacher_member', $scope.teacher);

        res.success(function(data, status, headers, config) {
            $scope.message2 = data;

            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };



});
