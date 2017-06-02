
app.controller('editProfileController',function($scope,$localStorage,$location, $http,$routeParams,profileStudent,$uibModal,Path_Api) {
    $scope.user = $localStorage.user;
    $scope.dataEditProfile;
    $scope.massageError;
    getData($localStorage.user.token,$localStorage.user.id);

    function getData(token,user_id) {

        profileStudent.getData(token,user_id).then(
            function(response){
                var data = response.data;
                if(data.status === "session expired"){
                    $scope.timeOut();
                }else{
                    $scope.dataEditProfile = addPathimg(data);
                    console.log($scope.dataEditProfile);
                }
            },
            function(response){
                // failure call back
            });

    }
    function addPathimg(data){
        data.image = "http://localhost:8000/api/image/"+data.image;
        return data;
    }

    $scope.editProfile = function(){
        $http.post(Path_Api.api_post_student_editProfile, $scope.dataEditProfile,{headers:{
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
    };


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
    };



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

    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }




});



