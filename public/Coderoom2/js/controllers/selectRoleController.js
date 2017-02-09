
app.controller('selectRoleController',function($scope,$http,$localStorage,$location) {
    $scope.user = $localStorage.user;


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
                    console.log(response);
                    delete $localStorage.user;
                    $location.path('#/home');
                },
                function(response){
                    // failure callback
                }
            );
    }
});

