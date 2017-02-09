
app.controller('addProblemteacherController',function($scope,Upload,$localStorage,$routeParams,$http,$location) {

    $scope.user = $localStorage.user;
    $localStorage.lesson_id = $routeParams.lessons_id;


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
    //upload
    $scope.uploadFiles = function(file) {
        console.log($scope.name);
        console.log($scope.description);
        console.log($scope.evaluator);
        console.log($scope.timelimit);
        console.log($scope.memorylimit);
        console.log($scope.is_parse);
        console.log(file);
        file.upload = Upload.upload({
            url: '/api/teacher/problem/store',
            data: {file: file,
                lesson_id:$localStorage.lessons_id,
                name:$scope.name,
                description:$scope.description,
                evaluator:$scope.evaluator,
                timelimit:$scope.timelimit,
                memorylimit:$scope.memorylimit,
                is_parse:$scope.is_parse
            },
            headers:{'Authorization_Token' : $localStorage.user.token},
        });

        file.upload.then(function (response) {
            $timeout(function () {
                console.log(response.data);
            })
        }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };
});




