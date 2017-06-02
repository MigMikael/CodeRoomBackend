
app.controller('selectRoleController',function($scope,$http,$localStorage,$location,Path_Api) {
    $scope.user = $localStorage.user;



    $scope.go = function ( path ) {
        $location.path( path );
    };
    $scope.logout = function () {

        $http.get(Path_Api.api_logout, {headers:{
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

