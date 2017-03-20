
app.controller('sortLessonController',function($scope,$localStorage,$routeParams,$http,$location,courseTeacher, $uibModal) {

    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;

    console.log($localStorage.course_id);
    getData($localStorage.user.token,$localStorage.course_id);
    function getData(token,course_id) {

        courseTeacher.getData(token,course_id).then(
            function(response){
                $scope.course = response.data;
                console.log($scope.course);

            },
            function(response){
                // failure call back
            });

    }
    $scope.sortLesson = function(){
        var lessons = $scope.course.lessons;
        $http.post('/api/teacher/lesson/change_order', lessons,{
                headers:{'Authorization_Token': $localStorage.user.token}
            })
            .then(
                function(response){

                    $location.path('/courseteacher/'+$scope.course.id);

                },
                function(response){
                    // failure callback
                }
            );
    }


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



