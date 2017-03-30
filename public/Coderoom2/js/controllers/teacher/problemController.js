
app.controller('problemTeacherController',function($scope,$localStorage,$routeParams,$http,$location,problemTeacher,studentSubmitProblem,viewCodeSubmit, $uibModal) {
    $scope.user = $localStorage.user;
    $localStorage.prob_id = $routeParams.prob_id;
    $scope.parseView = false;

    getData($localStorage.user.token,$localStorage.prob_id);

    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }

    function getData(token,prob_id) {

        problemTeacher.getData(token,prob_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.problem = data;
                console.log($scope.problem);
                getStudentsubmitProblem($localStorage.user.token,$localStorage.prob_id);
            },
            function(response){
                // failure call back
            });

    }

    function getStudentsubmitProblem(token,prob_id) {

        studentSubmitProblem.getData(token,prob_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                if(data.length >0){
                    $scope.studentSubmit = addPathimage(data);
                    console.log($scope.studentSubmit);
                    $scope.clickViewCode($localStorage.user.token,$scope.studentSubmit[0].sub_num);
                }


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
    function addPathimage(data){
        for(i=0 ; i<data.length ; i++){
            data[i].student.image = "http://localhost:8000/api/image/"+data[i].student.image;

        }

        return data;
    }
    $scope.clickViewCode = function(token,submit_id){
        viewCodeSubmit.getData(token,submit_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                if(data.length > 0){
                    $scope.allFiles = response.data;
                    console.log($scope.allFiles);
                    $scope.aceValue = $scope.allFiles[0].code;
                }

            },
            function(response){
                // failure call back
            });
    }
    $scope.clickChangeFile = function(index){
        $scope.aceValue = $scope.allFiles[index].code
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

    $scope.checkDeleteProblem = function (size, parentSelector,problem_id,problem_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            backdrop:'static',
            templateUrl: '../Coderoom2/js/views/model/tokenExpired.html',
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

});

