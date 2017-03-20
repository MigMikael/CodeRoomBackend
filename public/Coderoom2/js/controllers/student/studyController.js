
app.controller('studyController',function($scope,studyStudent,$localStorage,$http,$routeParams,$location,resultProblem,$uibModal) {
    $scope.isNav = false;

    $scope.user = $localStorage.user;
    $scope.study;
    $scope.problem;
    $scope.allFiles;
    $scope.aceValue;
    $scope.result;
    $scope.numberFile = null;
    $scope.massageCompare = {};
    $localStorage.lesson_id = $routeParams.lesson_id;
    $localStorage.course_name = $routeParams.course_name;
    $scope.course_name = $localStorage.course_name;
    getData($localStorage.user.token,$localStorage.lesson_id);




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
    $scope.$watch(function () { return $scope.numberFile; }, function (newData, oldData) {

        if($scope.numberFile !== null){
            $scope.numberFile = newData;
            if($scope.aceValue!== undefined && $scope.aceValue !== ""){
                $scope.allFiles[oldData].code = $scope.aceValue;
            }

            $scope.aceValue = $scope.allFiles[$scope.numberFile].code;
        }



    });
    $scope.changeFiles = function(id){
        $scope.numberFile = id;
    };




    function getData(token,lesson_id) {

        studyStudent.getData(token,lesson_id).then(
            function(response){
                var data = response.data;
                if(data.status === "session expired"){
                    $scope.timeOut();
                }else{
                    $scope.study = numberProblem(data);
                    if($scope.study.problems[0] !== null){
                        $scope.problem = $scope.study.problems[0];

                        getResult(token,$localStorage.user.id,$scope.problem.id);
                        console.log($scope.study);

                    }
                }
            },
            function(response){
                // failure call back
            });

    }

    function numberProblem(data){
        var count = 1;
        for(i=0 ; i<data.problems.length ; i++){
            data.problems[i].name = count+"."+data.problems[i].name;
            if(i===0){
                data.problems[i].active = true;
            }else if(i>0){
                data.problems[i].active = false;
            }

            count++;
        }
        return data;
    }

    function  getResult(token,student_id,problem_id){
        resultProblem.getData(token,student_id,problem_id).then(
            function(response){

                $scope.result = response.data;
                console.log(result);
                $scope.allFiles = $scope.result.submission_files;
                $scope.changeFiles(0);

            },
            function(response){
                // failure call back
            });
    }

    $scope.selectProblem = function (prob_id){

        $scope.study.problems[$scope.problem.order-1].active = false;
        $scope.study.problems[prob_id].active = true;
        $scope.problem = $scope.study.problems[prob_id];
        console.log($scope.problem);
        $scope.changeFiles(null);
        $scope.allFiles = [];
        $scope.aceValue = "";

        getResult($localStorage.user.token,$localStorage.user.id,$scope.problem.id);
        openNav();
    };

    //uploadZip
    $scope.$watch(function () { return $scope.zip; }, function (newData, oldData) {
        $scope.zip = newData;
        if($scope.zip !== undefined && $scope.zip.length !== 0 && $scope.zip.length !== null){
            $scope.allFiles = [];
            $scope.aceValue = null;
            $scope.changeFiles(null);
            readZip();

        }

    });




    $scope.readSuccess;

    function setAllFiles(zipEntrys) {

        if($scope.readSuccess== true)
            return;
        $scope.readSuccess = true;
        $scope.allFiles = zipEntrys;
        $scope.changeFiles(0);
        $scope.aceValue = "";

        $scope.$applyAsync();
        console.log($scope.allFiles);

    }

    function readZip(){

        var files = [];
        var zip = new JSZip();
        var zipEntrys = [];
        var prom = zip.loadAsync($scope.zip);
        prom.then(function(zip){
            $scope.readSuccess = false;
            var numFiles = 0;
            zip.forEach(function(relativePath, zipEntry){

                var path = zipEntry.name;
                var folder = path.split('/');
                var file = folder[folder.length-1].split('.');
                //java
                if(folder[1]=='src' && folder[2] !== "" && file[1] == "java") {
                    numFiles += 1;
                }
            });

            if(numFiles == 0){
                alert("Don't have src folder or java file");
                return;
            }else{
                var readFiles = 0;
                zip.forEach(function(relativePath, zipEntry) {

                    var path = zipEntry.name;
                    var folder = path.split('/');

                    var file = folder[folder.length-1].split('.');
                    if(folder[1]=='src' && folder[2] !== "" && file[1] == "java") {
                        var chackPackage = folder[2].split('.');
                        if(chackPackage[1]== "java"){
                            zipEntry.async("string").then(function success(content) {

                                var package = {package:"default package"};
                                package.filename = folder[folder.length-1];
                                package.code = content;

                                zipEntrys.push(package);
                                readFiles++;

                                if(readFiles == numFiles) {
                                    console.log("All files are read.");
                                    setAllFiles(zipEntrys);


                                }
                            });
                        }else{
                            zipEntry.async("string").then(function success(content) {
                                var package = {package:chackPackage[0]};
                                package.filename = folder[folder.length-1];

                                package.code = content;
                                zipEntrys.push(package);
                                readFiles++;
                                if(readFiles == numFiles) {
                                    console.log("All files are read.");
                                    setAllFiles(zipEntrys);


                                }
                            });
                        }

                    }
                });
            }
            return;
        });
        //prom.then(dummySuccess => runMe(zipEntrys));
    }
        function  runMe(code){
            console.log(code);
        }

    function compareResult (studentResult, teacherResult){
        for(i=0 ; i<teacherResult.length ; i++){
            for(j=0 ; j<teacherResult[i].problem_analysis.length ;j++){
                var haveClass = 0;
                var splitClassTeacher = teacherResult[i].problem_analysis[j].class.split(';');
                for(x=0 ; x<studentResult[i].results.length ; x++){
                    if(teacherResult[i].problem_analysis[j].class === studentResult[i].results[x].class && teacherResult[i].problem_analysis[j].score.class === studentResult[i].results[x].score.class){
                        haveClass++;
                        if(teacherResult[i].problem_analysis[j].score.package !== studentResult[i].results[x].score.package){
                            $scope.massageCompare.content = "package faill in class "+splitClassTeacher[2];
                            $scope.massageCompare.status = false;
                            return;
                        }
                        if(teacherResult[i].problem_analysis[j].score.enclose !== studentResult[i].results[x].score.enclose){
                            $scope.massageCompare.content = "enclose faill in class "+splitClassTeacher[2];
                            $scope.massageCompare.status = false;
                            return;
                        }
                        if(teacherResult[i].problem_analysis[j].score.extends !== studentResult[i].results[x].score.extends){
                            $scope.massageCompare.content = "extends faill in class "+splitClassTeacher[2];
                            $scope.massageCompare.status = false;
                            return;
                        }
                        if(teacherResult[i].problem_analysis[j].score.implements !== studentResult[i].results[x].score.implements){
                            $scope.massageCompare.content = "implements faill in class "+splitClassTeacher[2];
                            $scope.massageCompare.status = false;
                            return;
                        }
                        for(y=0 ; y<teacherResult[i].problem_analysis[j].constructors.length ; y++){
                            var haveConstructors = 0;
                            for(z=0 ; z<studentResult[i].results[x].constructors.length ; z++){

                                if(teacherResult[i].problem_analysis[j].constructors[y].name === studentResult[i].results[x].constructors[z].name && teacherResult[i].problem_analysis[j].constructors[y].score === studentResult[i].results[x].constructors[z].score && teacherResult[i].problem_analysis[j].constructors[y].parameter === studentResult[i].results[x].constructors[z].parameter){
                                    haveConstructors++;
                                }
                            }
                            if(haveConstructors === 0){
                                $scope.massageCompare.content = "None Constructor "+ teacherResult[i].problem_analysis[j].constructors[y].name+"("+teacherResult[i].problem_analysis[j].constructors[y].parameter+")";
                                $scope.massageCompare.status = false;
                                return;
                            }
                        }
                        for(y=0 ; y<teacherResult[i].problem_analysis[j].attributes.length ; y++){
                            var haveAttribute = 0
                            for(z=0 ; z<studentResult[i].results[x].attributes.length ; z++){
                                if(teacherResult[i].problem_analysis[j].attributes[y].name ===studentResult[i].results[x].attributes[z].name){
                                    haveAttribute++
                                    if(teacherResult[i].problem_analysis[j].attributes[y].access_modifier !== studentResult[i].results[x].attributes[z].access_modifier){
                                        $scope.massageCompare.content = "access_modifier faill in attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].attributes[y].non_access_modifier !== studentResult[i].results[x].attributes[z].non_access_modifier){
                                        $scope.massageCompare.content = "non_access_modifier faill in attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].attributes[y].data_type !== studentResult[i].results[x].attributes[z].data_type){
                                        $scope.massageCompare.content = "data_type faill in attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                }
                            }
                            if(haveAttribute === 0){
                                $scope.massageCompare.content = "None Attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                $scope.massageCompare.status = false;
                                return;
                            }
                        }
                        for(y=0 ; y< teacherResult[i].problem_analysis[j].methods.length ; y++){
                            var haveMethod = 0
                            for(z=0 ; z<studentResult[i].results[x].methods.length ; z++){
                                if(teacherResult[i].problem_analysis[j].methods[y].name ===studentResult[i].results[x].methods[z].name){
                                    haveMethod++
                                    if(teacherResult[i].problem_analysis[j].methods[y].access_modifier !== studentResult[i].results[x].methods[z].access_modifier){
                                        $scope.massageCompare.content = "access_modifier faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].non_access_modifier !== studentResult[i].results[x].methods[z].non_access_modifier){
                                        $scope.massageCompare.content = "non_access_modifier faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].return_type !== studentResult[i].results[x].methods[z].return_type){
                                        $scope.massageCompare.content = "return_type faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }if(teacherResult[i].problem_analysis[j].methods[y].parameter !== studentResult[i].results[x].methods[z].parameter){
                                        $scope.massageCompare.content = "parameter faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name+"("+teacherResult[i].problem_analysis[j].methods[y].parameter+")";
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].recursive !== studentResult[i].results[x].methods[z].recursive){
                                        $scope.massageCompare.content = "recursive faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].loop !== studentResult[i].results[x].methods[z].loop){
                                        $scope.massageCompare.content = "loop faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        $scope.massageCompare.status = false;
                                        return;
                                    }
                                }
                            }
                            if(haveMethod === 0){
                                $scope.massageCompare.content = "None Method "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                $scope.massageCompare.status = false;
                                return;
                            }
                        }



                    }else{
                        var splitClassStudent = studentResult[i].results[x].class.split(';');
                        if(splitClassTeacher[0] !== splitClassStudent[0] && splitClassTeacher[2] === splitClassStudent[2]){
                            $scope.massageCompare.content = "Access modifier Class fail";
                            $scope.massageCompare.status = false;
                            return;
                        }
                    }
                }
                if(haveClass === 0){
                    $scope.massageCompare.content = "None class"+ splitClassTeacher[2] + "in require techer";
                    $scope.massageCompare.status = false;
                    return;
                }
            }
        }
        $scope.massageCompare.content = "Success";
        $scope.massageCompare.status = true;

    }


    $scope.submitFile = function(){
        var dataSubmit = {
            files:$scope.allFiles,
            problem_id:$scope.problem.id,
            student_id:$localStorage.user.id,
        };
        console.log(dataSubmit);
        $http.post('/api/student/submission', dataSubmit,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    //console.log(response.data);
                    //console.log($scope.result);
                    $scope.massageCompare = {};
                    $scope.result.submission_files = response.data.submission_files;
                    console.log($scope.result);
                    if($scope.result.submission_files[0].results.length >0){

                        compareResult($scope.result.submission_files , $scope.result.problem.problem_files)
                    }
                    console.log($scope.massageCompare.status);
                    console.log($scope.massageCompare.content);


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

    $scope.openHover = function(){
        console.log("hello");
        if($scope.isNav){

            document.getElementById("hover").style.width = "0";
        }else{

            document.getElementById("hover").style.width = "100%";
        }
        $scope.isNav = !$scope.isNav;
    }



});

