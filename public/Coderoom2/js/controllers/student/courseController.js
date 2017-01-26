
app.controller('courseController',function($scope,$http,courseStudent,$localStorage,$routeParams,$location) {
    $scope.course;
    $localStorage.course_id = $routeParams.course_id;
    $scope.user = $localStorage.user;
    console.log($localStorage.course_id);
    getData($localStorage.user.token,$localStorage.course_id);

    function getData(token,course_id) {

        courseStudent.getData(token,course_id).then(
            function(response){
                $scope.course = response.data;
                console.log($scope.course);

            },
            function(response){
                // failure call back
            });

    }
    $scope.go = function ( path ) {
        $location.path( path );
    };

});

