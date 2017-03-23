
app.controller('courseTeacherController',function($scope,$localStorage,$location, $http,courseTeacher,$routeParams, $uibModal,$log) {
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;

    console.log($localStorage.course_id);
    getData($localStorage.user.token,$localStorage.course_id);

    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }

    function getData(token,course_id) {

        courseTeacher.getData(token,course_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.course = data;
                console.log($scope.course);

            },
            function(response){
                // failure call back
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
    $scope.deleteLesson = function(lesson_id){

        $http.delete('/api/teacher/lesson/delete/'+lesson_id,{headers:{
                'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    console.log(response);
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();


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

    $scope.checkDeleteLesson = function (size, parentSelector,lesson_id,lesson_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: '../Coderoom2/js/views/teacher/model/deleteLesson.html',
            controller: function($scope,$uibModalInstance){
                $scope.lessonName = lesson_name;
                $scope.confirmDeleteLesson = function () {
                    $uibModalInstance.close("deleteLesson");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "deleteLesson"){
                $scope.deleteLesson(lesson_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

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

    $scope.showCodeCourse = function (size, parentSelector,code_course) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',

            templateUrl: '../Coderoom2/js/views/teacher/model/showCodeCourse.html',
            controller: function($scope,$uibModalInstance){
                $scope.codeCourse = code_course;


                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };

            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {

        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }


});


