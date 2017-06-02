
app.controller('sortProblemController',function($scope,$localStorage,$routeParams,$http,$location,lessonTeacher, $uibModal,Path_Api) {

    $scope.user = $localStorage.user;
    $localStorage.lesson_id = $routeParams.lesson_id;

    getData($localStorage.user.token,$localStorage.lesson_id);

    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }

    function getData(token,lesson_id) {

        lessonTeacher.getData(token,lesson_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data)
                $scope.lesson = data;
                console.log($scope.lesson);

            },
            function(response){
                // failure call back
            });

    }
    $scope.sortProblem = function(){

        var problems = $scope.lesson.problems;
        $http.post(Path_Api.api_post_teacher_sortProblem, problems,{
                headers:{'Authorization_Token': $localStorage.user.token}
            })
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);

                    $location.path('/listproblemteacher/'+$localStorage.lessons_id);

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

    $scope.timeOut = function (size, parentSelector) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            backdrop:'static',
            templateUrl: '../Coderoom2/js/views/model/tokenExpired.html',
            controller: function($scope,$uibModalInstance){

                $scope.Login = function () {
                    $uibModalInstance.close("login");
                };

            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (login) {
            if(login==="login"){
                $scope.logout();
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }

});



