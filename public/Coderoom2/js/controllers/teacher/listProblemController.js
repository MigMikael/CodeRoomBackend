
app.controller('listProblemteacherController',function($scope,$localStorage,$routeParams,$http,$location,lessonTeacher, $uibModal) {

    $scope.user = $localStorage.user;
    $localStorage.lessons_id = $routeParams.lesson_id;




    getData($localStorage.user.token,$localStorage.lessons_id);


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
                $scope.checkTimeOut(data);
                $scope.lesson = data;
                console.log($scope.lesson);

            },
            function(response){
                // failure call back
            });

    }


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
    $scope.deleteProblem = function(prob_id){
        $http.delete('/api/teacher/problem/delete/'+ prob_id, {headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();
                    getData($localStorage.user.token,$localStorage.lessons_id);
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


    $scope.checkDeleteProblem = function (size, parentSelector,problem_id,problem_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            backdrop:'static',
            templateUrl: '../Coderoom2/js/views/teacher/model/deleteProblem.html',
            controller: function($scope,$uibModalInstance){
                $scope.problemName = problem_name;

                $scope.confirmDeleteProblem = function () {
                    $uibModalInstance.close("deleteProblem");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        });
        modalInstance.result.then(function (massage) {
            if(massage === "deleteProblem"){
                $scope.deleteProblem(problem_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    };


    $scope.deleteLesson = function(lesson_id){

        $http.delete('/api/teacher/lesson/delete/'+lesson_id,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){

                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();


                },
                function(response){
                    // failure callback
                }
            );
    }

    $scope.checkDeleteLesson = function (size, parentSelector,lesson_id,lesson_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: '../Coderoom2/js/views/teacher/model/deleteLesson.html',
            controller: function($scope,$uibModalInstance){
                $scope.lessonName = lesson_name;
                $scope.confirmDeleteLesson = function () {
                    $uibModalInstance.close("deleteLesson");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "deleteLesson"){
                $scope.deleteLesson(lesson_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }

});

