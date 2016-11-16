
app.controller('changeListlesson_teacherController',function($scope,coursePage_teachers,$stateParams,$rootScope,$localStorage) {
    $scope.course_teachers;
    getCourse();


    function getCourse() {

        coursePage_teachers.getCoursePage_teachers($localStorage.teacher_id,$localStorage.course_id_teacher)
            .success(function (data) {
                $scope.course_teachers = data;
                console.log($scope.course_teachers);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }

    $scope.$watch('course_teachers', function(model) {
        $scope.modelAsJson = angular.toJson(model, true);
    }, true);

    $scope.changeLesson = function(){
        var res = $http.post('/lesson', $scope.course_teachers);

        res.success(function(data, status, headers, config) {
            $scope.message2 = data;

            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };


});