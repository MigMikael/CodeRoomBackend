
app.controller('editAnnouncementteacherController',function($scope,$localStorage,$routeParams,$http,$location,announcementTeacher,$rootScope, $uibModal, Path_Api) {
    $scope.user = $localStorage.user;

    $localStorage.announcement_id = $routeParams.announcement_id;
    $rootScope.statusAnnouncement = "editAnnouncement";
    getData($localStorage.user.token,$localStorage.announcement_id);


    $scope.go = function ( path ) {
        $location.path( path );
    };

    $scope.announcement;
    function getData(token,announcement_id) {

        announcementTeacher.getData(token,announcement_id).then(
            function(response){
                var data = response.data;
                if(data.status === "session expired"){
                    $scope.timeOut();
                }
                $scope.announcement  = response.data;

                console.log($scope.announcement);

            },
            function(response){
                // failure call back
            });

    }

    $scope.editAnnouncement = function(){
        $http.post(Path_Api.api_post_teacher_editAnnoucement, $scope.announcement,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    var data = response.data;
                    if(data.status === "session expired"){
                        $scope.timeOut();
                    }else {
                        $location.path('/readannouncementteacher/'+$localStorage.announcement_id);
                    }
                },
                function(response){
                    // failure callback
                }
            );
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
    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }
});


/**
 * Created by thanadej on 2/4/2017 AD.
 */
