
app.controller('changePasswordAdminController',function($scope,$localStorage,$routeParams,$http,$location,$rootScope, $uibModal,Path_Api) {
    $scope.user = $localStorage.user;


    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

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


    $scope.confirm_password = false;
    $scope.comparePassword = function () {
        if($scope.new_password === $scope.new_password_confirm){
            $scope.confirm_password = true;

        }else{
            $scope.confirm_password = false;
        }
    };

    $scope.submitChangepassword = function(){
        var dataChangePassword = {
            teacher_id: $localStorage.user.id,
            old_password: $scope.old_password,
            new_password: $scope.new_password_confirm,
        };
        $http.post(Path_Api.api_post_teacher_changePassword, dataChangePassword,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    if(data.msg === "password is incorrect"){
                        $scope.massageError = "Old password incorrect";
                    }else{
                        $location.path('/profileteacher')
                    }

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
