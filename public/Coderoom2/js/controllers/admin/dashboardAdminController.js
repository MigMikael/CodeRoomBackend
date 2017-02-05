
app.controller('dashboardAdminController',function($scope,$http,dashBoardAdmin,$localStorage,$routeParams,$location) {
    $scope.user = $localStorage.user;
    $scope.dashBorad;
    getData($localStorage.user.token);
    function getData(token) {

        dashBoardAdmin.getData(token).then(
            function(response){
                $scope.dashBorad = response.data;
                console.log($scope.dashBorad);

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
