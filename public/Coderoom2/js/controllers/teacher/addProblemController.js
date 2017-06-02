
app.controller('addProblemteacherController',function($scope,Upload,$localStorage,$routeParams,$http,$location, $uibModal,Path_Api) {

    $scope.user = $localStorage.user;
    $localStorage.lesson_id = $routeParams.lessons_id;
    $scope.problemView = true;
    $scope.parseProblemView = false;
    $scope.statusFile = false;
    $scope.evaluator = {
        values:[
            {
                value:'java',
                name:'Java'
            },

        ],
        selectValue:{value:'java',name:'Java'}
    };
    $scope.is_parse = {
        values:[
            {
                value: true,
                name:'Parse'
            },
            {
                value: false,
                name:'Not Parse'
            },

        ],
        selectValue:{value: true ,name:'Parse'}
    };


    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }

    $scope.go = function ( path ) {
        $location.path( path );
    };



    $scope.logout = function () {

        $http.get(Path_Api.api_logout, {headders:{
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

    $scope.checkZip = function(zip){

        if(zip === null){
            $scope.statusFile = false;
        }else{
            $scope.statusFile = true;
        }
    };
    //upload

    $scope.uploadFiles = function(file) {

        $scope.loading = true;
        file.upload = Upload.upload({
            url: Path_Api.api_post_teacher_addProblem,
            data: {file: file,
                lesson_id:$localStorage.lessons_id,
                name:$scope.name,
                description:$scope.description,
                evaluator:$scope.evaluator.selectValue.value,
                timelimit:$scope.timelimit,
                memorylimit:$scope.memorylimit,
                is_parse:$scope.is_parse.selectValue.value
            },
            headers:{'Authorization_Token' : $localStorage.user.token},
        });

        file.upload.then(function (response) {
            $scope.loading = false;
            var data = response.data;
            if(data.status === "session expired"){
                $scope.timeOut();
            }else{

                if($scope.is_parse.selectValue.value){
                    $scope.changeViewCard("parseProblemView");
                    $scope.resultAnalysis = cutClass(data);
                    console.log($scope.resultAnalysis);
                }else{
                    $location.path('/listproblemteacher/'+$localStorage.lessons_id);
                }
            }


        }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };

    function cutClass(data){
        for(var i in data){
            if(i === "problem_files"){
                for(j=0 ; j<data[i].length ; j++){
                    for(z=0 ; z<data[i][j].problem_analysis.length ; z++){
                        var splitClass = data[i][j].problem_analysis[z].class.split(';');
                        data[i][j].problem_analysis[z].access_modifier_class = splitClass[0];
                        data[i][j].problem_analysis[z].non_access_modifier_class = splitClass[1];
                        data[i][j].problem_analysis[z].name_class = splitClass[2];
                    }

                }
            }
        }
        return data;
    }


    $scope.addScoreProblem = function(){
        $scope.loading = true;
        console.log($scope.resultAnalyze);
        $http.post(Path_Api.api_post_teacher_addScoreProblem, $scope.resultAnalysis, {headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    $scope.loading = false;
                    $location.path('/listproblemteacher/'+$localStorage.lessons_id);

                },
                function(response){
                    // failure callback
                }
           );
    }
    //cutClass($scope.resultAnalysis);
    $scope.changeView = function(view){
        if(view === "problemView"){
            $scope.problemView = true;
            $scope.parseProblemView = false;
            console.log("update view problemView");
        }else if(view === "parseProblemView"){
            $scope.problemView = false;
            $scope.parseProblemView = true;
            console.log("update view parseProblemView");
        }

    };


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




