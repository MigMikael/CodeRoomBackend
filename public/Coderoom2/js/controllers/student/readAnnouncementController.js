
app.controller('readAnnouncementstudentController',function($scope,$localStorage,$http, $location,$rootScope,$routeParams,announcementStudent,$routeParams) {


    $scope.announcement;
    $rootScope.user = $localStorage.user;
    $localStorage.announcement_id = $routeParams.announcement_id;
    getData($localStorage.user.token,$localStorage.announcement_id);
    function getData(token,announcement_id) {

        announcementStudent.getData(token,announcement_id).then(
            function(response){

                $scope.announcement = response.data;
                console.log($scope.announcement);

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

