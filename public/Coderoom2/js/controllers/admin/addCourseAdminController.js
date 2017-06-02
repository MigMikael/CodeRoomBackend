

app.controller('addCourseAdminController',function($scope,$http,$localStorage,$routeParams,$location,allTeacherAdmin,Path_Api) {
    $scope.user = $localStorage.user;
    $scope.massage = "";
    $scope.teachers = {
        All_Teacher:[

        ],
        Add_Teacher:[


        ],

    }
    $scope.courseNmae;
    $scope.image;
    $scope.isImage = false;
    $scope.codeColor;
    $scope.isColor = false
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


    $scope.createCourse = function(file) {

        if($scope.teachers.Add_Teacher > 0){
            $scope.loading = true;
            file.upload = Upload.upload({
                url: Path_Api.api_post_admin_createCourse,
                data: {image: file,
                    name : $scope.courseName,
                    color : $scope.codeColor,
                    teachers : $scope.teachers.All_Teacher
                },
                headers:{'Authorization_Token' : $localStorage.user.token},
            });

            file.upload.then(function (response) {
                $scope.loading = false;
                var data = response.data;
                $scope.checkTimeOut(data);
                console.log(data);
                console.log("success");


            }, function (response) {
                if (response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                // Math.min is to fix IE which reports 200% sometimes
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }else{
            $scope.massage = "Drag Teacher into Add_Teachers"
        }

    };
    $scope.checkImage = function (image) {

        if(image !== null){
            var type = image.type
            var arraySplit = type.split('/');
            if(arraySplit[0] === "image"){
                $scope.isImage = true;
            }else{
                $scope.isImage = false;
            }
        }else{
            $scope.isImage = false;
        }

    }

    $scope.checkColor = function (color) {
        if(color !== ""){
            $scope.isColor = true;
        }else {
            $scope.isColor = false;
        }
    }


});
