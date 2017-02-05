
app.controller('homeController',function($scope,$http,$localStorage,$location,home) {
    $scope.buttonLogin = true;
    $scope.buttonRegister = false;
    $scope.postUser ={};
    $localStorage.user;
    getData();
    $scope.switchMode = function(status){
        if(status == "login"){

            $scope.buttonLogin = true;
            $scope.buttonRegister = false;

        }else if(status == "register"){
            $scope.buttonLogin = false;
            $scope.buttonRegister = true;
        }

    };

    function getData() {

        home.getData().then(
            function(response){
                $scope.courses = response.data;
                console.log($scope.courses);

            },
            function(response){
                // failure call back
            });

    }



    $scope.login = function () {
        $http.post('/login', $scope.postUser)
            .then(
                function(response){
                    // success
                    $localStorage.user = addPathimg(response.data);
                    console.log($localStorage.user);
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

    function addPathimg(data){
        data.image = "http://localhost:8000/api/image/"+data.image;
        return data;
    }

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
        }else if(role=="teacher"){
            $location.path('/dashboardteacher');
        }else if(role==="admin"){
            $location.path('/selectrole');
        }
    }
});
