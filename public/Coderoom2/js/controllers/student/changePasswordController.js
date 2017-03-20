
app.controller('changePasswordController',function($scope,$localStorage,$location, $http,$routeParams,$uibModal) {
    $scope.user = $localStorage.user;
    $scope.massageError;

    $scope.confirm_password = false;
    $scope.comparePassword = function () {
        if($scope.new_password === $scope.new_password_confirm){
            $scope.confirm_password = true;

        }else{
            $scope.confirm_password = false;
        }
    };


    $scope.go = function (path) {
        $location.path(path);
    };

    $scope.logout = function () {

        $http.get('/logout', {
                headers: {
                    'Authorization_Token': $localStorage.user.token
                }
            })
            .then(
                function (response) {
                    delete $localStorage.user;
                    $location.path('/home');
                },
                function (response) {
                    // failure callback
                }
            );
    };




    $scope.submitChangepassword = function () {
        var dataChangePassword = {
            student_id: $localStorage.user.id,
            old_password: $scope.old_password,
            new_password: $scope.new_password_confirm,
        };
        console.log(dataChangePassword)
        $http.post('/api/student/change_password', dataChangePassword, {
                headers: {
                    'Authorization_Token': $localStorage.user.token
                }
            })
            .then(
                function (response) {
                    console.log(response.data);
                    var data = response.data;
                    if (data.msg === "password is incorrect") {
                        $scope.massageError = "password incorrect";
                    } else if(data.status === "session expired"){
                        $scope.timeOut();
                    }else{
                        $location.path('/profilestudent');
                    }

                },
                function (response) {
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



