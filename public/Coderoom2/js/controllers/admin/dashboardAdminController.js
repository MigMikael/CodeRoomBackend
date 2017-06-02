
app.controller('dashboardAdminController',function($scope,$http,dashBoardAdmin,$localStorage,$routeParams,$location,$uibModal,$log,Path_Api) {
    $scope.user = $localStorage.user;
    $scope.dashBorad;

    $scope.isViewCourse = true;
    $scope.isViewTeacher = false;
    $scope.isViewAdmin = false;

    getDeashBoard($localStorage.user.token);
    function getDeashBoard(token) {

        dashBoardAdmin.getData(token).then(
            function(response){
                var data = response.data;

                $scope.checkTimeOut(data);
                $scope.dashBorad = addPathimage(data);
                console.log($scope.dashBorad);

            },
            function(response){
                // failure call back
            });

    }

    $scope.changeView = function (view) {
        if(view === "course"){
            $scope.isViewCourse = true;
            $scope.isViewTeacher = false;
            $scope.isViewAdmin = false;
        }else if(view === "teacher"){
            $scope.isViewCourse = false;
            $scope.isViewTeacher = true;
            $scope.isViewAdmin = false;
        }else if(view === "admin"){
            $scope.isViewCourse = false;
            $scope.isViewTeacher = false;
            $scope.isViewAdmin = true;
        }
    }


    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

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
    $scope.disableCourse = function (course_id) {
        var path = Path_Api.api_get_admin_disableEnableCourse+course_id;
        $http.get(path,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();

                },
                function(response){

                }
            );
    }

    $scope.checkDisableCourse = function (size, parentSelector,course_id,course_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: '../Coderoom2/js/views/admin/model/disableCourse.html',
            controller: function($scope,$uibModalInstance){
                $scope.courseName = course_name;
                $scope.confirmDisableCourse = function () {
                    $uibModalInstance.close("disableCourse");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "disableCourse"){
                $scope.disableCourse(course_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }

    $scope.enableCourse = function (course_id) {
        var path = Path_Api.api_get_admin_disableEnableCourse+course_id;
        $http.get(path,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();

                },
                function(response){

                }
            );
    }


    $scope.checkInActiveTeacher = function (size, parentSelector,teacher_id,teacher_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: '../Coderoom2/js/views/admin/model/inActiveTeacher.html',
            controller: function($scope,$uibModalInstance){
                $scope.teacherName = teacher_name;
                $scope.confirmInActiveTeacher = function () {
                    $uibModalInstance.close("inactiveteacher");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "inactiveteacher"){
                $scope.inActiveTeacher(teacher_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }


    $scope.inActiveTeacher = function (teacher_id) {
        var path = Path_Api.api_get_admin_disableEnableTeacher+teacher_id;
        $http.get(path,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();
                    $scope.changeView('teacher');

                },
                function(response){

                }
            );
    }
    $scope.activeTeacher = function (teacher_id) {
        var path = Path_Api.api_get_admin_disableEnableTeacher+teacher_id;
        $http.get(path,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    location.reload();
                    $scope.changeView('teacher');

                },
                function(response){

                }
            );
    }


    function addPathimage(data){
        for(var i in data){
            if(i=="teacher"){
                for(j=0 ; j<data[i].length;j++){
                    data[i][j].image = Path_Api.path_image+data[i][j].image;
                }
            }
        }
        return data;
    }


});
