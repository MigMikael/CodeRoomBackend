
app.controller('dashBoardstudentController',function($scope,$localStorage,dashBoardStudent,$http, $location,$rootScope,$uibModal, $log, $document) {
    $scope.cardUser = false;

    getData($localStorage.user.token);
    $scope.dataDashboard;
    $rootScope.user = $localStorage.user;

    function getData(token) {

        dashBoardStudent.getData(token).then(
            function(response){
                var data = response.data;
                if(data.status === "session expired"){
                    $scope.timeOut();
                }else{
                    $scope.dataDashboard = deleteCourse(data);
                    console.log($scope.dataDashboard);
                }


            },
            function(response){

                // failure call back
            });

    }


    function deleteCourse(data){

        for(i=0 ; i<data.student.courses.length ; i++){

            for(j=0 ; j<data.courses.length ;j++){
                if(data.student.courses[i].course_id===data.courses[j].id){

                    data.courses.splice(j,1);


                }
            }
        }
        return data;
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

    $scope.logout = function (page) {

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




    //model
    $scope.animationsEnabled = true;

    $scope.joinCourse = function (size, parentSelector) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: '../Coderoom2/js/views/student/model/joinCourse.html',
            controller: function($scope,$uibModalInstance){
                $scope.token_course;
                $scope.submitToken = function () {
                    $uibModalInstance.close($scope.token_course);
                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (token) {
            $scope.submitTokenCourse(token);
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }
    $scope.submitTokenCourse = function(){
        $http.post('/api', $scope.token_course, {
                headers: {
                    'Authorization_Token': $localStorage.user.token
                }
            })
            .then(
                function (response) {
                    console.log(response.data);
                    var data = response.data;
                    /*
                     if(success){
                     window.location.reload()
                     //$location.path('/dashboardstudent');
                     }else{
                     $scope.massageSubmitToken.msg = data.msg;
                     $scope.massageSubmitToken.status = true;
                     }
                     */
                },
                function (response) {
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

