

app.controller('addQuiz_teachersController',function($scope,$stateParams,$http) {

    $scope.course_id = $stateParams.course_id;

    $scope.quiz = {
        course_id: $scope.course_id,
        status: "false",
    };
    $scope.addQuiz = function(){

        var res = $http.post('/lesson', $scope.quiz);
        res.success(function(data, status, headers, config) {
            $scope.message2 = data;
            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };


});

