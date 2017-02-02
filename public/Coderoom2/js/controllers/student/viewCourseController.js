
app.controller('viewCourseController',function($scope,$http,courseStudent,$localStorage,$routeParams,$location) {
    $scope.course;
    $scope.cardUser = false;
    $localStorage.course_id = $routeParams.course_id;
    $scope.user = $localStorage.user;


    getData($localStorage.user.token,$localStorage.course_id,$localStorage.user.id);

    function getData(token,course_id,student_id) {

        courseStudent.getData(token,course_id,student_id).then(
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
    $scope.go = function ( path ) {
        $location.path( path );
    };

    $scope.logout = function () {

        $http.get('/logout', {headders:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    delete $localStorage.user;
                    $location.path('/home');
                },
                function(response){
                    // failure callback
                }
            );
    }


});

