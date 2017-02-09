
app.controller('editProblemteacherController',function($scope,$localStorage,$routeParams,$http,$location,problemTeacher) {
    $scope.user = $localStorage.user;
    $localStorage.prob_id = $routeParams.prob_id;
    console.log($localStorage.lesson_id);
    getData($localStorage.user.token,$localStorage.lesson_id );

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


    function getData(token,prob_id) {

        problemTeacher.getData(token,prob_id).then(
            function(response){
                $scope.lesson = response.data;
                console.log($scope.lesson);

            },
            function(response){
                // failure call back
            });

    }


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


