
app.controller('registerController',function($scope,$http,$localStorage,$location,Path_Api) {

    $localStorage.user;


    $scope.login = function () {
        $http.post(Path_Api.api_login, $scope.postUser)
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
    };
    $scope.go = function ( path ) {
        $location.path( path );
    };

    function addPathimg(data){
        data.image = "http://localhost:8000/api/image/"+data.image;
        return data;
    }

    $scope.logout = function () {

        $http.get(Path_Api.api_login, {headers:{
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
