
app.controller('profileAdminController',function($scope,$localStorage,$location, $http,$routeParams, $uibModal,Path_Api) {
    $scope.user = $localStorage.user;
    $scope.profile = true;
    $scope.changePassword = false;
    $scope.editProfile = false;


    //getData($localStorage.user.token,$localStorage.course_id);

    function getData(token,course_id) {

        courseTeacher.getData(token,course_id).then(
            function(response){
                $scope.course = response.data;
                console.log($scope.course);

            },
            function(response){
                // failure call back
            });

    }
    $scope.changeView = function(view){
        if(view === "profile"){
            $scope.profile = true;
            $scope.changePassword = false;
            $scope.editProfile = false;
        }else if(view === "changePassword"){
            $scope.profile = false;
            $scope.changePassword = true;
            $scope.editProfile = false;
        }else if(view === "editProfile"){
            $scope.editProfile = true;
            $scope.profile = false;
            $scope.changePassword = false;
        }
    };

    $scope.go = function ( path ) {
        $location.path( path );
    };

    $scope.logout = function () {

        $http.get(Path_Api.api_logout, {headers:{
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



