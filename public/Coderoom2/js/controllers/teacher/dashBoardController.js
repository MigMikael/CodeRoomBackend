
app.controller('dashBoardteacherController',function($scope,$http,$localStorage,$location,$rootScope,dashboardTeacher) {
    $scope.user = $localStorage.user;
    getData($localStorage.user.token);
    $scope.dataDashboard;


    function getData(token) {

        dashboardTeacher.getData(token).then(
            function(response){

                $scope.dataDashboard = response.data;
                console.log($scope.dataDashboard);

            },
            function(response){
                // failure call back
            });

    }
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
    $scope.openCarduser  = function(){
        if($scope.cardUser){
            document.getElementById("showCarduser").style.display = "none";


        }else {
            document.getElementById("showCarduser").style.display = "block";

        }
        $scope.cardUser = !$scope.cardUser;
    };

});

