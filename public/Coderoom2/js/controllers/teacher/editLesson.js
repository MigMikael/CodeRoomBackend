
app.controller('editLessonteacherController',function($scope,$localStorage,$routeParams,$http,$location,lessonTeacher, $uibModal) {
    $scope.user = $localStorage.user;
    $localStorage.lesson_id = $routeParams.lesson_id;

    getData($localStorage.user.token,$localStorage.lesson_id);

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

    $scope.lesson;
    function getData(token,lesson_id) {

        lessonTeacher.getData(token,lesson_id).then(
            function(response){
                $scope.lesson = response.data;
                console.log($scope.lesson);

            },
            function(response){
                // failure call back
            });

    }

    $scope.editLesson = function(){
        $http.post('/api/teacher/lesson/edit', $scope.lesson,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    $location.path('/courseteacher/'+$scope.lesson.course_id);
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


