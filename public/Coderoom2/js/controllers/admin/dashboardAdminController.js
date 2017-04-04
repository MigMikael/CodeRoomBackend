
app.controller('dashboardAdminController',function($scope,$http,dashBoardAdmin,$localStorage,$routeParams,$location,$uibModal,$log) {
    $scope.user = $localStorage.user;
    $scope.dashBorad;
    getData($localStorage.user.token);
    function getData(token) {

        dashBoardAdmin.getData(token).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.dashBorad = response.data;
                console.log($scope.dashBorad);

            },
            function(response){
                // failure call back
            });

    }

    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

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
    $scope.disableCourse = function (course_id) {
        $http.post('/', course_id,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();

                },
                function(response){

                }
            );
    }

    $scope.checkDisableCourse = function (size, parentSelector,course_id,course_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: '../Coderoom2/js/views/admin/model/disableCourse.html',
            controller: function($scope,$uibModalInstance){
                $scope.courseName = course_name;
                $scope.confirmDisableCourse = function () {
                    $uibModalInstance.close("disableCourse");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "disableCourse"){
                $scope.disableCourse(course_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }


});
