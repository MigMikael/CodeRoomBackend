
app.controller('homeController',function($scope,$http,$localStorage) {
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
                    console.log($localStorage.user);
                },
                function(response){
                    // failure callback
                }
            );
    }

    $scope.logout = function () {

        $http.get('/logout', {headders:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    console.log(response);
                    delete $localStorage.user;
                    console.log($localStorage.user);
                },
                function(response){
                    // failure callback
                }
            );
    }
});
