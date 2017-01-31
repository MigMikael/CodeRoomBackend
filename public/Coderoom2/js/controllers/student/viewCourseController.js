
app.controller('viewCourseController',function($scope,$http,courseStudent,$localStorage,$routeParams,$location) {
    $scope.course;
    $scope.cardUser = false;
    $localStorage.course_id = $routeParams.course_id;

    console.log($scope.user);

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

    $scope.openCarduser  = function(){
        if($scope.cardUser){
            document.getElementById("showCarduser").style.display = "none";


        }else {
            document.getElementById("showCarduser").style.display = "block";

        }
        $scope.cardUser = !$scope.cardUser;
    };


});

