/**
 * Created by thanadej on 4/5/2017 AD.
 */



app.controller('addTeacherCourseAdminController',function($scope,$http,$localStorage,$routeParams,$location,teacherCourseAdmin,allTeacherAdmin,Path_Api, $uibModal) {
    $scope.user = $localStorage.user;

    $localStorage.course_id = $routeParams.course_id;

    $scope.teachers = {
        Teachers:[],
        Teachers_Course:[],
    }

    getAllTeacher($localStorage.user.token);
    function getAllTeacher(token) {

        allTeacherAdmin.getData(token).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.teachers.Teachers = data;
                console.log("allTeacher");
                console.log(data);
                getTeacherCourse(token,$localStorage.course_id);
            },
            function(response){
                // failure call back
            });



    }

    function getTeacherCourse(token,cousre_id) {
        teacherCourseAdmin.getData(token,cousre_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.teachers.Teachers_Course = data;
                console.log("TeacherCourse");
                console.log(data);
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
        var path = Path_Api.api_post_admin_addTeacherCourse+$localStorage.course_id;
        var data = {
            teachers : $scope.teachers.Teachers_Course
        }
        $http.post(path, data ,{headers:{
            'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    var data = response.data;
                    $scope.checkTimeOut(data);
                    if(data.msg === "add Teacher Complete"){
                        $location.path('/dashboardadmin');
                    }


                },
                function(response){
                    // failure callback
                }
            );
    }


});
