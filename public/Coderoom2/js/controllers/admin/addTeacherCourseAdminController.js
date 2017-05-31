/**
 * Created by thanadej on 4/5/2017 AD.
 */



app.controller('addTeacherCourseAdminController',function($scope,$http,$localStorage,$routeParams,$location,teacherCourseAdmin,allTeacherAdmin) {
    $scope.user = $localStorage.user;

    $localStorage.course_id = $routeParams.course_id;

    $scope.teachers = {
        Teachers:[],
        Teachers_Course:[],
    }

    //getAllTeacher($localStorage.user.token);
    function getAllTeacher(token) {

        allTeacherAdmin.getData(token).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.teachers.Teachers = data;
                getTeacherCourse(token);
            },
            function(response){
                // failure call back
            });



    }

    function getTeacherCourse(token) {
        teacherCourseAdmin.getData(token).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.teachers.Teachers_Course = data;
                manageTeachers();
            },
            function(response){
                // failure call back
            });
    }

    function manageTeachers() {
        for(i=0 ; i<$scope.teachers.Teachers_Course.length ; i++){
            for(j=0 ; j< $scope.teachers.Teachers.length ; j++){
                if($scope.teachers.Teachers_Course[i].id === $scope.teachers.Teachers[j].id){
                    $scope.teachers.Teachers.splice(j,1);
                }
            }
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

    $scope.addTeacherCourse = function(){

        $http.post('/', $scope.teachers.Teachers_Course ,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    $scope.go('/dashboardadmin');

                },
                function(response){
                    // failure callback
                }
            );
    }


});
