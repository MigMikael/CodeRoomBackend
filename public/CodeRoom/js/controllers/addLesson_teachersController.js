
app.controller('addLesson_teachersController',function($scope,$stateParams,$http) {

    $scope.course_id = $stateParams.course_id;

    $scope.lesson = {
        course_id: $scope.course_id,
        status: "true",
    };

    $scope.addLesson = function(){
        var res = $http.post('http://posttestserver.com/post.php', $scope.lesson);

        res.success(function(data, status, headers, config) {
            $scope.message2 = data;

            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };



});