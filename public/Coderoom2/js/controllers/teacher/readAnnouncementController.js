
app.controller('readAnnouncementteacherController',function($scope,$localStorage,$http,$sce, $location,$rootScope,$routeParams,announcementTeacher, $uibModal) {


    $scope.announcement;
    $rootScope.user = $localStorage.user;
    $localStorage.announcement_id = $routeParams.announcement_id;
    getData($localStorage.user.token,$localStorage.announcement_id);

    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }

    function getData(token,announcement_id) {

        announcementTeacher.getData(token,announcement_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.announcement = parseStringtoHTML(data);
                console.log($scope.announcement);

            },
            function(response){
                // failure call back
            });

    }
    function parseStringtoHTML(data){
        data.content = $sce.trustAsHtml(data.content);
        return data;
    }
    $scope.deleteAnnouncement = function(announcement_id){

        $http.delete('/api/teacher/announcement/delete/'+announcement_id,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    //console.log(response);
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    $location.path('/courseteacher/'+$localStorage.course_id);


                },
                function(response){
                    // failure callback
                }
            );
    }


    $scope.checkDeleteAnnouncement = function (size, parentSelector,announcement_id,title) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: '../Coderoom2/js/views/teacher/model/deleteAnnouncement.html',
            controller: function($scope,$uibModalInstance){
                $scope.title = title;
                $scope.confirmDeleteAnnouncement = function () {
                    $uibModalInstance.close("deleteAnnouncment");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "deleteAnnouncment"){
                $scope.deleteAnnouncement(announcement_id);
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

