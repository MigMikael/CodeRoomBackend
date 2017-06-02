
app.controller('viewMemberteacherController',function($scope,viewMemberTeacher,$localStorage,$http,$routeParams,$location, $uibModal,$log,Path_Api) {
    $scope.viewMember;
    $scope.cardUser = false;
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;
    $scope.isDelfuteView = true;
    $scope.isLessonView = false;
    $scope.sortView = {
        select: {
            view:"default"
        },
        values:[
            {
                view:"default"
            },
            {
                view:"lesson"
            }
        ]

    }
    getData($localStorage.user.token,$localStorage.course_id);

    $scope.$watch(function () { return $scope.sortView.select.view; }, function (newData, oldData) {
        if(newData === "default"){
            $scope.isDelfuteView = true;
            $scope.isLessonView = false;

        }else if(newData === "lesson"){
            $scope.isDelfuteView = false;
            $scope.isLessonView = true;
        }

    });

    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }


    function getData(token,course_id) {

        viewMemberTeacher.getData(token,course_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data)
                $scope.viewMember = addPathimage(data);
                console.log($scope.viewMember);

            },
            function(response){
                // failure call back
            });

    }
    function addPathimage(data){
        for(var i in data){
            if(i=="students"){
                for(j=0 ; j<data[i].length;j++){
                    data[i][j].image = "http://localhost:8000/api/image/"+data[i][j].image;
                }
            }else if(i=="teachers"){
                for(j=0 ; j<data[i].length;j++){
                    data[i][j].image = "http://localhost:8000/api/image/"+data[i][j].image;
                }
            }
        }
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

    $scope.enableOrdisableStudent = function(student_id){
        $http.get(Path_Api.api_get_teacher_disableStudent+student_id+"/"+$localStorage.course_id,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
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

    $scope.chackDisableStudent = function (size, parentSelector,student_id,student_name) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',

            templateUrl: '../Coderoom2/js/views/teacher/model/disableStudent.html',
            controller: function($scope,$uibModalInstance){
                $scope.studentName = student_name;
                $scope.confirmDisableStudent = function () {
                    $uibModalInstance.close("DisableStudent");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };

            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "DisableStudent"){
                $scope.enableOrdisableStudent(student_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }

    $scope.enableStudent = function (student_id) {
        $scope.enableOrdisableStudent(student_id);
    }


    $scope.showCodeCourse = function (size, parentSelector,code_course) {
        console.log(code_course);
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

    $scope.chackDropIP = function (size, parentSelector,student_id,student_name,student_ip) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',

            templateUrl: '../Coderoom2/js/views/teacher/model/dropIPStudent.html',
            controller: function($scope,$uibModalInstance){
                $scope.student = {
                    name: student_name,
                    ip: student_ip,
                }

                $scope.confirmDropIP = function () {
                    $uibModalInstance.close("DropIP");

                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };

            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (massage) {
            if(massage === "DropIP"){
                $scope.dropIP(student_id);
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }

    $scope.dropIP = function (student_id) {

        $http.get(Path_Api.api_get_teacher_dropIpStudent+student_id,{headers:{
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




});

/**
 * Created by thanadej on 1/30/2017 AD.
 */
