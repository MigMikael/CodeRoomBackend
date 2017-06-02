
app.controller('viewCourseController',function($scope,$http,courseStudent,$localStorage,$routeParams,$location,$uibModal,Path_Api) {
    $scope.course;
    $scope.cardUser = false;
    $localStorage.course_id = $routeParams.course_id;
    $scope.user = $localStorage.user;


    getData($localStorage.user.token,$localStorage.course_id,$localStorage.user.id);

    function getData(token,course_id,student_id) {

        courseStudent.getData(token,course_id,student_id).then(
            function(response){
                var data = response.data;
                console.log(data);
                if(data.status === "session expired"){
                    $scope.timeOut();
                }else{
                    $scope.course = data;
                    console.log($scope.course);
                }
            },
            function(response){
                // failure call back
            });

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

