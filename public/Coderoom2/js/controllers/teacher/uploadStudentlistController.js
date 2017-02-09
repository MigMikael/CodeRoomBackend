
app.controller('uploadStudentlistController',function($scope,$localStorage,$routeParams,$http,$location) {
    $localStorage.course_id = $routeParams.course_id;
    $scope.user = $localStorage.user;
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

    $scope.uploadFiles = function() {


        file.upload = Upload.upload({
            url: '/',
            data: {zip: $scope.zip,course_id: $localStorage.course_id},
        });

        file.upload.then(function (response) {
            $timeout(function () {
                console.log(response);
            });
        }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };
});



