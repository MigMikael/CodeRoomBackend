
app.controller('addLessonteacherController',function($scope,$localStorage,$routeParams,$http,$location) {
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;

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

        $http.get('/logout', {headers:{
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
    };
    $scope.lesson = {
        course_id: $localStorage.course_id,
    };

    $scope.addLesson = function(){
        $http.post('/api/teacher/lesson/store', $scope.lesson,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    $location.path('/courseteacher/'+$localStorage.course_id);
                },
                function(response){
                    // failure callback
                }
            );
    }

});



