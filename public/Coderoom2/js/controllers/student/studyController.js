
app.controller('studyController',function($scope,studyStudent,$localStorage,$http,$routeParams,$location,resultProblem) {
    $scope.isNav = false;
    $scope.cardUser = false;

    $scope.user = $localStorage.user;
    $scope.study;
    $scope.problem;
    $scope.allFiles;
    $scope.aceValue;
    $scope.result;

    $localStorage.lesson_id = $routeParams.lesson_id;
    getData($localStorage.user.token,$localStorage.lesson_id);

    function openNav(){
        if($scope.isNav){
            document.getElementById("hover").style.display = "none";
            document.getElementById("hover").style.width = "0%";

        }else {
            document.getElementById("hover").style.display = "block";
            document.getElementById("hover").style.width = "100%";
        }
        $scope.isNav = !$scope.isNav;
    };
    $scope.openNavview  = function(){
        if($scope.isNav){
            document.getElementById("hover").style.display = "none";
            document.getElementById("hover").style.width = "0%";

        }else {
            document.getElementById("hover").style.display = "block";
            document.getElementById("hover").style.width = "100%";
        }
        $scope.isNav = !$scope.isNav;
    };

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





    function getData(token,lesson_id) {

        studyStudent.getData(token,lesson_id).then(
            function(response){
                $scope.study = numberProblem(response.data);
                console.log();
                if($scope.study.problems[0] !== null){
                    $scope.problem = $scope.study.problems[0];
                    getResult(token,$localStorage.user.id,$scope.problem.id);
                    console.log($scope.study);
                    console.log($scope.problem);
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
                $scope.allFiles = $scope.result.submission_files;
                console.log($scope.result);
            },
            function(response){
                // failure call back
            });
    }
    function splitclass(data){
        for(i=0 ; i<data.submission_files.length ;i++){
            for(j=0 ;j<data.submission_files[i].results.length ; j++){
                var splitClass = data.submission_files[i].results[j].class.split(';');
                data.submission_files[i].results[j].class = splitClass[0]+" "+splitClass[1];
            }

        }
        return data;
    }
    $scope.selectProblem = function (prob_id){

        $scope.study.problems[$scope.problem.order-1].active = false;
        $scope.study.problems[prob_id].active = true;
        $scope.problem = $scope.study.problems[prob_id];
        console.log($scope.problem);
        getResult($localStorage.user.token,$localStorage.user.id,$scope.problem.id);
        openNav();
    };

    //uploadZip
    $scope.$watch(function () { return $scope.zip; }, function (newData, oldData) {
        $scope.zip = newData;
        if($scope.zip !== undefined && $scope.zip.length !== 0 && $scope.zip.length !== null){
            readZip();

        }

    });
    $scope.allFiles = [];



    $scope.readSuccess;

    function setAllFiles(zipEntrys) {
        console.log("setAllFiles");
        if($scope.readSuccess== true)
            return;
        $scope.readSuccess = true;
        $scope.allFiles = zipEntrys;
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

    $scope.$watch(function () { return $scope.numberFile; }, function (newData, oldData) {
        $scope.numberFile = newData;

        if($scope.aceValue!== undefined){
            $scope.allFiles[oldData].code = $scope.aceValue;
        }
        $scope.aceValue = $scope.allFiles[$scope.numberFile].code;

    });
    $scope.changeFiles = function(id){
        $scope.numberFile = id;

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
                    console.log(response);
                },
                function(response){
                    // failure callback
                }
            );

    }
});

