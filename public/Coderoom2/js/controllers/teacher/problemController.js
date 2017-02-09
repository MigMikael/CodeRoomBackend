
app.controller('problemTeacherController',function($scope,$localStorage,$routeParams,$http,$location,problemTeacher) {
    $scope.user = $localStorage.user;
    $localStorage.prob_id = $routeParams.prob_id;


    getData($localStorage.user.token,$localStorage.prob_id);

    function getData(token,prob_id) {

        problemTeacher.getData(token,prob_id).then(
            function(response){
                $scope.problem = response.data;
                console.log($scope.problem);

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
});

