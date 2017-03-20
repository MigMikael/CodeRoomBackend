
app.controller('problemTeacherController',function($scope,$localStorage,$routeParams,$http,$location,problemTeacher,studentSubmitProblem,viewCodeSubmit, $uibModal) {
    $scope.user = $localStorage.user;
    $localStorage.prob_id = $routeParams.prob_id;


    getData($localStorage.user.token,$localStorage.prob_id);

    function getData(token,prob_id) {

        problemTeacher.getData(token,prob_id).then(
            function(response){
                $scope.problem = response.data;
                console.log($scope.problem);
                getStudentsubmitProblem($localStorage.user.token,$localStorage.prob_id);
            },
            function(response){
                // failure call back
            });

    }

    function getStudentsubmitProblem(token,prob_id) {

        studentSubmitProblem.getData(token,prob_id).then(
            function(response){
                if(response.data.length >0){
                    $scope.studentSubmit = addPathimage(response.data);
                    console.log($scope.studentSubmit);
                    $scope.clickViewCode($scope.studentSubmit[0].sub_num);
                }


            },
            function(response){
                // failure call back
            });

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
    function addPathimage(data){
        for(i=0 ; i<data.length ; i++){
            data[i].student.image = "http://localhost:8000/api/image/"+data[i].student.image;

        }

        return data;
    }
    $scope.clickViewCode = function(submit_id){
        viewCodeSubmit.getData($localStorage.user.token,submit_id).then(
            function(response){
                if(response.data.length > 0){
                    $scope.allFiles = response.data;
                    console.log($scope.allFiles);
                    $scope.aceValue = $scope.allFiles[0].code;
                }

            },
            function(response){
                // failure call back
            });
    }
    $scope.clickChangeFile = function(index){
        $scope.aceValue = $scope.allFiles[index].code
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

