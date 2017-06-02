
app.controller('readAnnouncementstudentController',function($scope,$localStorage,$http,$sce, $location,$rootScope,$routeParams,announcementStudent,$routeParams,$uibModal,Path_Api) {


    $scope.announcement;
    $rootScope.user = $localStorage.user;
    $localStorage.announcement_id = $routeParams.announcement_id;
    getData($localStorage.user.token,$localStorage.announcement_id);
    function getData(token,announcement_id) {

        announcementStudent.getData(token,announcement_id).then(
            function(response){
                var data = response.data;

                if(data.status === "session expired"){
                    $scope.timeOut();
                }else{
                    $scope.announcement = parseStringtoHTML(data);
                    console.log($scope.announcement);
                }
            },
            function(response){
                // failure call back
            });

    }
    function parseStringtoHTML(data){
        data.content = $sce.trustAsHtml(data.content);
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

});

