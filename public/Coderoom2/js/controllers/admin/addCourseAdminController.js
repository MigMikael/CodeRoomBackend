

app.controller('addCourseAdminController',function($scope,$http,$localStorage,$routeParams,$location,allTeacherAdmin) {
    $scope.user = $localStorage.user;
    $scope.massage = "";
    $scope.teachers = {
        All_Teacher:[

        ],
        Add_Teacher:[


        ],

    }
    getData($localStorage.user.token);
    function getData(token) {

        allTeacherAdmin.getData(token).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.teachers.All_Teacher = data;

            },
            function(response){
                // failure call back
            });

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
    $scope.addCourse = function () {
        if($scope.teachers.Add_Teacher.length > 0){
            $http.get('/api/', {headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
                .then(
                    function(response){
                        var data = response.data;
                        $scope.checkTimeOut(data)
                        console.log(data);
                    },
                    function(response){
                        // failure callback
                    }
                );
        }else{
            $scope.massage = "Drag teacher into Add_Teacher !";
        }

    }



});
