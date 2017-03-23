
app.controller('addAnnouncementteacherController',function($scope,$localStorage,$routeParams,$http,$location,$rootScope, $uibModal) {
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;

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

    $scope.announcement = {
        course_id: $localStorage.course_id,

    };
    $scope.addAnnouncement = function(){
        $scope.announcement.content  = $rootScope.announcement_content;
        console.log($rootScope.announcement_content);
        $http.post('/api/teacher/announcement/store', $scope.announcement,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    var data = response.data;
                    console.log(data);
                    if(data.status === "session expired"){
                        $scope.timeOut();
                    }else{
                        $location.path('/courseteacher/'+$localStorage.course_id);
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
