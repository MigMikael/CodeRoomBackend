
app.controller('loginController',function($scope,$http,$localStorage,$location) {
    $localStorage.user;
    $scope.massageError;
    $scope.formLoginView ={
        usernameError:false,
        passwordError:false
    }
    $scope. loginForm = function () {
        var dataLogin = {
            username: $scope.username,
            password: $scope.password
        };

        $http.post('/login', dataLogin)
            .then(
                function(response){
                    // success
                    var dataResponse = response.data;
                    if(dataResponse.msg === "username is incorrect"){
                        $scope.formLoginView.usernameError = true;

                    }else if(dataResponse.msg === "password is incorrect"){
                        $scope.formLoginView.passwordError = true;
                    }else {
                        $localStorage.user = addPathimg(response.data);
                        console.log($localStorage.user);
                        checkRole($localStorage.user.role);
                    }
                    $scope.massageError = dataResponse.msg;

                },
                function(response){
                    // failure callback
                }
            );
    };

    $scope.go = function ( path ) {
        $location.path( path );
    };

    function addPathimg(data){
        data.image = "http://localhost:8000/api/image/"+data.image;
        return data;
    }

    function checkRole(role){
        if(role==="student"){
            $location.path('/dashboardstudent');
        }else if(role=="teacher"){
            $location.path('/dashboardteacher');
        }else if(role==="admin"){
            $location.path('/selectrole');
        }
    }
});
