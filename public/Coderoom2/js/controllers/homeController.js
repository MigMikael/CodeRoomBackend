
app.controller('homeController',function($scope,$http,$localStorage,$location) {
    $scope.buttonLogin = true;
    $scope.buttonRegister = false;
    $scope.switchMode = function(status){
        if(status == "login"){

            $scope.buttonLogin = true;
            $scope.buttonRegister = false;

        }else if(status == "register"){
            $scope.buttonLogin = false;
            $scope.buttonRegister = true;
        }

    };

    $scope.postUser ={};
    $localStorage.user;

    $scope.login = function () {
        $http.post('/login', $scope.postUser)
            .then(
                function(response){
                    // success
                    $localStorage.user = response.data;
                    checkRole($localStorage.user.role);
                },
                function(response){
                    // failure callback
                }
            );
    }
    $scope.go = function ( path ) {
        $location.path( path );
    };


    $scope.logout = function () {

        $http.get('/logout', {headders:{
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

    function checkRole(role){
        if(role==="student"){
           $location.path('/dashboardstudent');
        }else if(role="teacher"){
            $location.path('/dashboardteacher');
        }else if(role="admin"){

        }
    }
});
