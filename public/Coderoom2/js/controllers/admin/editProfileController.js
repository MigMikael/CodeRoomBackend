
app.controller('editProfileAdminController',function($scope,$localStorage,$routeParams,$http,$location,$rootScope, $uibModal,profileTeacher,Path_Api) {
    $scope.user = $localStorage.user;





    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }

    getData($localStorage.user.token,$localStorage.user.id);

    function getData(token,user_id) {

        profileTeacher.getData(token,user_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.dataEditProfile = addPathimg(data);
                console.log($scope.dataEditProfile);

            },
            function(response){
                // failure call back
            });

    }
    function addPathimg(data){
        data.image = "http://localhost:8000/api/image/"+data.image;
        return data;
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
    $scope.editProfile = function(){
        $http.post(Path_Api.api_post_teacher_editProfile, $scope.dataEditProfile,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    if(data.msg === "edit complete"){
                        $location.path('/profileteacher');
                    }else{
                        $scope.massageError = "Error";
                    }
                },
                function(response){
                    // failure callback
                }
            );
    };


});
