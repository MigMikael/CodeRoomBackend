
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
                $scope.study = response.data;
                $scope.problem = $scope.study.problems[0];

                getResult(token,$localStorage.user.id,$scope.problem.id);

                console.log($scope.study);
                console.log($scope.problem);
            },
            function(response){
                // failure call back
            });

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

    $scope.selectProblem = function(prob_id){
        console.log(prob_id);
        $scope.problem = $scope.study.problems[prob_id];
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

                                var package = {packagename:"default package"};
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
                                var package = {packagename:chackPackage[0]};
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
});

