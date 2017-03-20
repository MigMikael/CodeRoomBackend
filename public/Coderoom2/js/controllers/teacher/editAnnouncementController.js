
app.controller('editAnnouncementteacherController',function($scope,$localStorage,$routeParams,$http,$location,announcementStudentTeacher, $uibModal) {
    $scope.user = $localStorage.user;

    getData($localStorage.user.token,$localStorage.announcement_id);

    $scope.openCarduser  = function(){
        if($scope.cardUser){
            document.getElementById("showCarduser").style.display = "none";


        }else {
            document.getElementById("showCarduser").style.display = "block";

        }
        $scope.cardUser = !$scope.cardUser;
    };
    $scope.go = function ( path ) {
        $location.path( path );
    };

    $scope.announcement;
    function getData(token,announcement_id) {

        announcementStudentTeacher.getData(token,announcement_id).then(
            function(response){

                $scope.announcement  = response.data;
                console.log($scope.announcement);

            },
            function(response){
                // failure call back
            });

    }

    $scope.editAnnouncement = function(){
        $http.post('/api/teacher/announcement/edit', $scope.announcement,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    $location.path('/readannouncementteacher/'+$localStorage.announcement_id);
                },
                function(response){
                    // failure callback
                }
            );
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


/**
 * Created by thanadej on 2/4/2017 AD.
 */
