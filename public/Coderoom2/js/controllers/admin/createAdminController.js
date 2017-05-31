

app.controller('createAdminController',function($scope,$http,$localStorage,$routeParams,$location,allTeacherAdmin,allAdmin) {
    $scope.user = $localStorage.user;

    $scope.admin_teacher = {
        Teachers: [],
        Admins: [],

    }

    //getAllAdmin($localStorage.user.token);
    function getAllAdmin(token) {

        allAdmin.getData(token).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.admin_teacher.Admins = data;
                getAllTeacher();
            },
            function(response){
                // failure call back
            });

    }
    function getAllTeacher() {
        allTeacherAdmin.getData(token).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.admin_teacher.Teachers = data;

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

    $scope.addAdmin = function () {

        $http.post('/', $scope.admin_teacher.Admins ,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    $scope.go('/dashboardadmin');

                },
                function(response){
                    // failure callback
                }
            );
    }



});
