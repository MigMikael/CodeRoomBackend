
app.controller('listProblemteacherController',function($scope,$localStorage,$routeParams,$http,$location,lessonTeacher) {

    $scope.user = $localStorage.user;
    $localStorage.lessons_id = $routeParams.lesson_id;




    getData($localStorage.user.token,$localStorage.lessons_id);

    function getData(token,lesson_id) {

        lessonTeacher.getData(token,lesson_id).then(
            function(response){

                $scope.lesson = response.data;
                console.log($scope.lesson);

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
    }
    $scope.deleteProblem = function(prob_id){
        $http.delete('/api/teacher/problem/delete/'+ prob_id, {headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    location.reload();
                    getData($localStorage.user.token,$localStorage.lessons_id);
                },
                function(response){
                    // failure callback
                }
            );
    }
});

