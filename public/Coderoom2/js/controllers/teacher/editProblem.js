


app.controller('editProblemteacherController',function($scope,Upload,$localStorage,$routeParams,$http,$location, $uibModal,$log,problemTeacher) {

    $scope.user = $localStorage.user;
    $localStorage.prob_id = $routeParams.prob_id;

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


    getData($localStorage.user.token,$localStorage.prob_id);


    $scope.checkTimeOut = function(data){
        if(data.status !== undefined){
            if(data.status === "session expired"){
                $scope.timeOut()
            }
        }

    }
    getData($localStorage.user.token,$localStorage.prob_id);
    function getData(token,prob_id) {

        problemTeacher.getData(token,prob_id).then(
            function(response){
                var data = response.data;
                $scope.checkTimeOut(data);
                $scope.problem = data;
                $scope.evaluator.selectValue.value =  $scope.problem.evaluator;
                $scope.evaluator.selectValue.name = $scope.problem.evaluator;
                if($scope.problem.is_parse === "true"){
                    $scope.is_parse.selectValue.value = "true";
                    $scope.is_parse.selectValue.name = "Parse";
                }else{
                    $scope.is_parse.selectValue.value = "false";
                    $scope.is_parse.selectValue.name = "Not Parse";
                }

                console.log($scope.problem);
            },
            function(response){
                // failure call back
            });

    }


    $scope.go = function ( path ) {
        $location.path( path );
    };



    $scope.logout = function () {

        $http.get('/logout', {headders:{
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
            url: '/api/teacher/problem/store',
            data: {file: file,
                problem_id:$scope.problem.id,
                name:$scope.problem.name,
                description:$scope.problem.description,
                evaluator:$scope.evaluator.selectValue.value,
                timelimit:$scope.problem.timelimit,
                memorylimit:$scope.problem.memorylimit,
                is_parse:$scope.is_parse.selectValue.value
            },
            headers:{'Authorization_Token' : $localStorage.user.token},
        });

        file.upload.then(function (response) {
            $scope.loading = false;
            var data = response.data;
            $scope.checkTimeOut(data);
            if($scope.is_parse.selectValue.value){
                changeViewCard("parseProblemView");
                //cutClass ยังไม่ได้ทำ เพราะไม่แน่ใจที่ข้อมูลคืนกลัยมา
                $scope.resultAnalysis = data;
                console.log($scope.resultAnalysis);
            }else{
                $location.path('/listproblemteacher/'+$localStorage.lessons_id);
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

    /* $scope.resultAnalysis = {
     "lesson_id": "2",
     "name": "Runners",
     "description": "ฝึกการใช้ method",
     "evaluator": "java",
     "order": 1,
     "timelimit": "1",
     "memorylimit": "32000",
     "is_parse": "true",
     "updated_at": "2017-02-16 13:06:58",
     "created_at": "2017-02-16 13:06:58",
     "id": 2,
     "problem_files": [
     {
     "id": 2,
     "problem_id": 2,
     "package": "default package",
     "filename": "Runners.java",
     "mime": "java",
     "code": "",
     "problem_analysis": [
     {
     "id": 3,
     "problemfile_id": 2,
     "class": "public;null;Runners",
     "package": "",
     "enclose": "null",
     "extends": "",
     "implements": "",
     "created_at": "2017-02-16 13:07:04",
     "updated_at": "2017-02-16 13:07:04",
     "score": {
     "id": 3,
     "analysis_id": 3,
     "class": 0,
     "package": 0,
     "enclose": 0,
     "extends": 0,
     "implements": 0
     },
     "attributes": [
     {
     "id": 7,
     "analysis_id": 3,
     "access_modifier": "default",
     "non_access_modifier": "null",
     "data_type": "int",
     "name": "round",
     "score": 0
     },
     {
     "id": 8,
     "analysis_id": 3,
     "access_modifier": "default",
     "non_access_modifier": "null",
     "data_type": "float",
     "name": "time",
     "score": 0
     }
     ],
     "constructors": [],
     "methods": [
     {
     "id": 10,
     "analysis_id": 3,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "void",
     "name": "printTest",
     "parameter": "",
     "recursive": "",
     "loop": "",
     "score": 0
     }
     ]
     },
     {
     "id": 4,
     "problemfile_id": 2,
     "class": "default;null;Runner",
     "package": "",
     "enclose": "Runners",
     "extends": "",
     "implements": "",
     "created_at": "2017-02-16 13:07:04",
     "updated_at": "2017-02-16 13:07:04",
     "score": {
     "id": 4,
     "analysis_id": 4,
     "class": 0,
     "package": 0,
     "enclose": 0,
     "extends": 0,
     "implements": 0
     },
     "attributes": [
     {
     "id": 9,
     "analysis_id": 4,
     "access_modifier": "default",
     "non_access_modifier": "null",
     "data_type": "int",
     "name": "no",
     "score": 0
     },
     {
     "id": 10,
     "analysis_id": 4,
     "access_modifier": "default",
     "non_access_modifier": "null",
     "data_type": "int",
     "name": "speed",
     "score": 0
     },
     {
     "id": 11,
     "analysis_id": 4,
     "access_modifier": "default",
     "non_access_modifier": "null",
     "data_type": "float",
     "name": "wasteTime",
     "score": 0
     },
     {
     "id": 12,
     "analysis_id": 4,
     "access_modifier": "default",
     "non_access_modifier": "null",
     "data_type": "float",
     "name": "totalTime",
     "score": 0
     }
     ],
     "constructors": [
     {
     "id": 2,
     "analysis_id": 4,
     "access_modifier": "public",
     "name": "Runner",
     "parameter": "int;no|int;speed|float;wasteTime|",
     "score": 0
     }
     ],
     "methods": [
     {
     "id": 11,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "int",
     "name": "getNo",
     "parameter": "",
     "recursive": "",
     "loop": "",
     "score": 0
     },
     {
     "id": 12,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "void",
     "name": "setNo",
     "parameter": "int;no|",
     "recursive": "",
     "loop": "",
     "score": 0
     },
     {
     "id": 13,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "int",
     "name": "getSpeed",
     "parameter": "",
     "recursive": "",
     "loop": "",
     "score": 0
     },
     {
     "id": 14,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "void",
     "name": "setSpeed",
     "parameter": "int;speed|",
     "recursive": "",
     "loop": "",
     "score": 0
     },
     {
     "id": 15,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "float",
     "name": "getWasteTime",
     "parameter": "",
     "recursive": "",
     "loop": "",
     "score": 0
     },
     {
     "id": 16,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "void",
     "name": "setWasteTime",
     "parameter": "float;wasteTime|",
     "recursive": "",
     "loop": "",
     "score": 0
     },
     {
     "id": 17,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "float",
     "name": "getTotalTime",
     "parameter": "",
     "recursive": "",
     "loop": "",
     "score": 0
     },
     {
     "id": 18,
     "analysis_id": 4,
     "access_modifier": "public",
     "non_access_modifier": "null",
     "return_type": "void",
     "name": "setTotalTime",
     "parameter": "float;totalTime|",
     "recursive": "",
     "loop": "",
     "score": 0
     }
     ]
     }
     ]
     }
     ]
     };*/
    $scope.addScoreProblem = function(){
        $scope.loading = true;
        console.log($scope.resultAnalyze);
        $http.post('/api/teacher/problem/store_score', $scope.resultAnalysis, {headers:{
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
    function changeViewCard(view){
        console.log(view);
        if(view === "problemView"){
            $scope.problemView = true;
            $scope.parseProblemView = false;
            console.log("update view problemView");
        }else if(view === "parseProblemView"){
            $scope.problemView = false;
            $scope.parseProblemView = true;
            console.log("update view parseProblemView");
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


});









