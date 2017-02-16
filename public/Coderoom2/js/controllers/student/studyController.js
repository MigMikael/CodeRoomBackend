
app.controller('studyController',function($scope,studyStudent,$localStorage,$http,$routeParams,$location,resultProblem) {
    $scope.isNav = false;
    $scope.cardUser = false;

    $scope.user = $localStorage.user;
    $scope.study;
    $scope.problem;
    $scope.allFiles;
    $scope.aceValue;
    /*$scope.result = {
        "id": 1,
        "student_id": 3,
        "problem_id": 1,
        "sub_num": 1,
        "is_accept": "true",
        "created_at": "2017-02-16 15:25:14",
        "updated_at": "2017-02-16 15:25:22",
        "problem_files": [
            {
                "id": 1,
                "submission_id": 1,
                "package": "default package",
                "filename": "Runners.java",
                "mime": "java",
                "code": "import java.util.Comparator;\r\nimport java.util.Scanner;\r\nimport static java.util.Comparator.*;\r\nimport java.util.ArrayList;\r\nimport java.util.Collections;\r\n\r\npublic class Runners {\r\n    static int round, time;\r\n    \r\n    \r\n    public static void main(String[] args) {\r\n        Scanner in = new Scanner(System.in);\r\n        int num = in.nextInt();\r\n        System.out.println(num);\r\n\r\n    }\r\n    \r\n    public void printTest(){\r\n        \r\n    }\r\n}\r\n\r\n\r\nclass Runner {\r\n\tint no;\r\n\tint speed;\r\n\tfloat wasteTime;\r\n\tfloat totalTime;\r\n\t\r\n\tpublic Runner(int no ,int speed, float wasteTime) {\r\n\t\tthis.no = no;\r\n\t\tthis.speed = speed;\r\n\t\tthis.wasteTime = wasteTime;\r\n\t}\r\n\t\r\n\tpublic int getNo() {\r\n\t\treturn no;\r\n\t}\r\n        \r\n\tpublic void setNo(int no) {\r\n\t\tthis.no = no;\r\n\t}\r\n        \r\n\tpublic int getSpeed() {\r\n\t\treturn speed;\r\n\t}\r\n        \r\n\tpublic void setSpeed(int speed) {\r\n\t\tthis.speed = speed;\r\n\t}\r\n        \r\n\tpublic float getWasteTime() {\r\n\t\treturn wasteTime;\r\n\t}\r\n        \r\n\tpublic void setWasteTime(float wasteTime) {\r\n\t        this.wasteTime = wasteTime;\r\n\t}\r\n        \r\n\tpublic float getTotalTime() {\r\n\t\treturn totalTime;\r\n\t}\r\n        \r\n\tpublic void setTotalTime(float totalTime) {\r\n\t\tthis.totalTime = totalTime;\r\n\t}\r\n}\r\n\r\n",
                "outputs": [
                    {
                        "id": 1,
                        "submissionfile_id": 1,
                        "content": "",
                        "score": 100,
                        "error": "No Error"
                    }
                ],
                "problem_analysis": [
                    {
                        "id": 1,
                        "submissionfile_id": 1,
                        "class": "public;null;Runners",
                        "package": "",
                        "enclose": "null",
                        "extends": "",
                        "implements": "",
                        "created_at": "2017-02-16 15:25:17",
                        "updated_at": "2017-02-16 15:25:17",
                        "score": {
                            "id": 1,
                            "result_id": 1,
                            "class": 1,
                            "package": 0,
                            "enclose": 1,
                            "extends": 0,
                            "implements": 0
                        },
                        "attributes": [
                            {
                                "id": 1,
                                "result_id": 1,
                                "access_modifier": "default",
                                "non_access_modifier": "null",
                                "data_type": "int",
                                "name": "round",
                                "score": 1
                            }
                        ],
                        "constructors": [],
                        "methods": [
                            {
                                "id": 1,
                                "result_id": 1,
                                "access_modifier": "public",
                                "non_access_modifier": "static",
                                "return_type": "void",
                                "name": "main",
                                "parameter": "String[];args|",
                                "recursive": "",
                                "loop": "",
                                "score": 0
                            },
                            {
                                "id": 2,
                                "result_id": 1,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "void",
                                "name": "printTest",
                                "parameter": "",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            }
                        ]
                    },
                    {
                        "id": 2,
                        "submissionfile_id": 1,
                        "class": "default;null;Runner",
                        "package": "",
                        "enclose": "null",
                        "extends": "",
                        "implements": "",
                        "created_at": "2017-02-16 15:25:17",
                        "updated_at": "2017-02-16 15:25:17",
                        "score": {
                            "id": 2,
                            "result_id": 2,
                            "class": 1,
                            "package": 0,
                            "enclose": 1,
                            "extends": 0,
                            "implements": 0
                        },
                        "attributes": [
                            {
                                "id": 2,
                                "result_id": 2,
                                "access_modifier": "default",
                                "non_access_modifier": "null",
                                "data_type": "int",
                                "name": "no",
                                "score": 1
                            },
                            {
                                "id": 3,
                                "result_id": 2,
                                "access_modifier": "default",
                                "non_access_modifier": "null",
                                "data_type": "int",
                                "name": "speed",
                                "score": 1
                            },
                            {
                                "id": 4,
                                "result_id": 2,
                                "access_modifier": "default",
                                "non_access_modifier": "null",
                                "data_type": "float",
                                "name": "wasteTime",
                                "score": 1
                            },
                            {
                                "id": 5,
                                "result_id": 2,
                                "access_modifier": "default",
                                "non_access_modifier": "null",
                                "data_type": "float",
                                "name": "totalTime",
                                "score": 1
                            }
                        ],
                        "constructors": [
                            {
                                "id": 1,
                                "result_id": 2,
                                "access_modifier": "public",
                                "name": "Runner",
                                "parameter": "int;no|int;speed|float;wasteTime|",
                                "score": 0
                            }
                        ],
                        "methods": [
                            {
                                "id": 3,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "int",
                                "name": "getNo",
                                "parameter": "",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            },
                            {
                                "id": 4,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "void",
                                "name": "setNo",
                                "parameter": "int;no|",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            },
                            {
                                "id": 5,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "int",
                                "name": "getSpeed",
                                "parameter": "",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            },
                            {
                                "id": 6,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "void",
                                "name": "setSpeed",
                                "parameter": "int;speed|",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            },
                            {
                                "id": 7,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "float",
                                "name": "getWasteTime",
                                "parameter": "",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            },
                            {
                                "id": 8,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "void",
                                "name": "setWasteTime",
                                "parameter": "float;wasteTime|",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            },
                            {
                                "id": 9,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "float",
                                "name": "getTotalTime",
                                "parameter": "",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            },
                            {
                                "id": 10,
                                "result_id": 2,
                                "access_modifier": "public",
                                "non_access_modifier": "null",
                                "return_type": "void",
                                "name": "setTotalTime",
                                "parameter": "float;totalTime|",
                                "recursive": "",
                                "loop": "",
                                "score": 1
                            }
                        ]
                    }
                ]
            }
        ],
        "problem": {
            "id": 1,
            "lesson_id": 1,
            "name": "Runners",
            "description": "f;laksd;l",
            "evaluator": "java",
            "order": 1,
            "timelimit": 1,
            "memorylimit": 32000,
            "is_parse": "true",
            "created_at": "2017-02-16 15:23:37",
            "updated_at": "2017-02-16 15:23:37",
            "problem_files": [
                {
                    "id": 1,
                    "problem_id": 1,
                    "package": "default package",
                    "filename": "Runners.java",
                    "mime": "java",
                    "code": "",
                    "problem_analysis": [
                        {
                            "id": 1,
                            "problemfile_id": 1,
                            "class": "public;null;Runners",
                            "package": "",
                            "enclose": "null",
                            "extends": "",
                            "implements": "",
                            "created_at": "2017-02-16 15:23:40",
                            "updated_at": "2017-02-16 15:23:40",
                            "score": {
                                "id": 1,
                                "result_id": 1,
                                "class": 1,
                                "package": 0,
                                "enclose": 1,
                                "extends": 0,
                                "implements": 0
                            },
                            "attributes": [
                                {
                                    "id": 1,
                                    "analysis_id": 1,
                                    "access_modifier": "default",
                                    "non_access_modifier": "null",
                                    "data_type": "int",
                                    "name": "round",
                                    "score": 1
                                },
                                {
                                    "id": 2,
                                    "analysis_id": 1,
                                    "access_modifier": "default",
                                    "non_access_modifier": "null",
                                    "data_type": "float",
                                    "name": "time",
                                    "score": 1
                                }
                            ],
                            "constructors": [],
                            "methods": [
                                {
                                    "id": 1,
                                    "analysis_id": 1,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "void",
                                    "name": "printTest",
                                    "parameter": "",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                }
                            ]
                        },
                        {
                            "id": 2,
                            "problemfile_id": 1,
                            "class": "default;null;Runner",
                            "package": "",
                            "enclose": "Runners",
                            "extends": "",
                            "implements": "",
                            "created_at": "2017-02-16 15:23:40",
                            "updated_at": "2017-02-16 15:23:40",
                            "score": {
                                "id": 1,
                                "result_id": 1,
                                "class": 1,
                                "package": 0,
                                "enclose": 1,
                                "extends": 0,
                                "implements": 0
                            },
                            "attributes": [
                                {
                                    "id": 3,
                                    "analysis_id": 2,
                                    "access_modifier": "default",
                                    "non_access_modifier": "null",
                                    "data_type": "int",
                                    "name": "no",
                                    "score": 1
                                },
                                {
                                    "id": 4,
                                    "analysis_id": 2,
                                    "access_modifier": "default",
                                    "non_access_modifier": "null",
                                    "data_type": "int",
                                    "name": "speed",
                                    "score": 1
                                },
                                {
                                    "id": 5,
                                    "analysis_id": 2,
                                    "access_modifier": "default",
                                    "non_access_modifier": "null",
                                    "data_type": "float",
                                    "name": "wasteTime",
                                    "score": 1
                                },
                                {
                                    "id": 6,
                                    "analysis_id": 2,
                                    "access_modifier": "default",
                                    "non_access_modifier": "null",
                                    "data_type": "float",
                                    "name": "totalTime",
                                    "score": 1
                                }
                            ],
                            "constructors": [
                                {
                                    "id": 1,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "name": "Runner",
                                    "parameter": "int;no|int;speed|float;wasteTime|",
                                    "score": 0
                                }
                            ],
                            "methods": [
                                {
                                    "id": 2,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "int",
                                    "name": "getNo",
                                    "parameter": "",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                },
                                {
                                    "id": 3,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "void",
                                    "name": "setNo",
                                    "parameter": "int;no|",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                },
                                {
                                    "id": 4,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "int",
                                    "name": "getSpeed",
                                    "parameter": "",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                },
                                {
                                    "id": 5,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "void",
                                    "name": "setSpeed",
                                    "parameter": "int;speed|",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                },
                                {
                                    "id": 6,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "float",
                                    "name": "getWasteTime",
                                    "parameter": "",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                },
                                {
                                    "id": 7,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "void",
                                    "name": "setWasteTime",
                                    "parameter": "float;wasteTime|",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                },
                                {
                                    "id": 8,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "float",
                                    "name": "getTotalTime",
                                    "parameter": "",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                },
                                {
                                    "id": 9,
                                    "analysis_id": 2,
                                    "access_modifier": "public",
                                    "non_access_modifier": "null",
                                    "return_type": "void",
                                    "name": "setTotalTime",
                                    "parameter": "float;totalTime|",
                                    "recursive": "",
                                    "loop": "",
                                    "score": 1
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    };
*/
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
                $scope.study = numberProblem(response.data);
                //console.log();
                if($scope.study.problems[0] !== null){
                    $scope.problem = $scope.study.problems[0];
                    //getResult(token,$localStorage.user.id,$scope.problem.id);
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
                $scope.changeFiles(0);
                console.log($scope.aceValue);
                console.log($scope.result);
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
        console.log("setAllFiles");
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
                for(x=0 ; x<studentResult[i].problem_analysis.length ; x++){
                    if(teacherResult[i].problem_analysis[j].class === studentResult[i].problem_analysis[x].class && teacherResult[i].problem_analysis[j].score.class === studentResult[i].problem_analysis[x].score.class){
                        haveClass++;
                        if(teacherResult[i].problem_analysis[j].score.package !== studentResult[i].problem_analysis[x].score.package){
                            $scope.massageCompare = "package faill in class "+splitClassTeacher[2];
                            return;
                        }
                        if(teacherResult[i].problem_analysis[j].score.enclose !== studentResult[i].problem_analysis[x].score.enclose){
                            $scope.massageCompare = "enclose faill in class "+splitClassTeacher[2];
                            return;
                        }
                        if(teacherResult[i].problem_analysis[j].score.extends !== studentResult[i].problem_analysis[x].score.extends){
                            $scope.massageCompare = "extends faill in class "+splitClassTeacher[2];
                            return;
                        }
                        if(teacherResult[i].problem_analysis[j].score.implements !== studentResult[i].problem_analysis[x].score.implements){
                            $scope.massageCompare = "implements faill in class "+splitClassTeacher[2];
                            return;
                        }
                        for(y=0 ; y<teacherResult[i].problem_analysis[j].constructors.length ; y++){
                            var haveConstructors = 0;
                            for(z=0 ; z<studentResult[i].problem_analysis[x].constructors.length ; z++){
                                if(teacherResult[i].problem_analysis[j].constructors[y].name === studentResult[i].problem_analysis[x].constructors.name && teacherResult[i].problem_analysis[j].constructors[y].score === studentResult[i].problem_analysis[x].constructors.score && teacherResult[i].problem_analysis[j].constructors[y].parameter === studentResult[i].problem_analysis[x].constructors.parameter){
                                    haveConstructors++;
                                }
                            }
                            if(haveConstructors === 0){
                                $scope.massageCompare = "None Constructor "+ teacherResult[i].problem_analysis[j].constructors[y].name+"("+teacherResult[i].problem_analysis[j].constructors[y].parameter+")";
                                return;
                            }
                        }
                        for(y=0 ; y<teacherResult[i].problem_analysis[j].attributes.length ; y++){
                            var haveAttribute = 0
                            for(z=0 ; z<studentResult[i].problem_analysis[x].attributes.length ; z++){
                                if(teacherResult[i].problem_analysis[j].attributes[y].name ===studentResult[i].problem_analysis[x].attributes[z].name){
                                    haveAttribute++
                                    if(teacherResult[i].problem_analysis[j].attributes[y].access_modifier !== studentResult[i].problem_analysis[x].attributes[z].access_modifier){
                                        $scope.massageCompare = "access_modifier faill in attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].attributes[y].non_access_modifier !== studentResult[i].problem_analysis[x].attributes[z].non_access_modifier){
                                        $scope.massageCompare = "non_access_modifier faill in attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].attributes[y].data_type !== studentResult[i].problem_analysis[x].attributes[z].data_type){
                                        $scope.massageCompare = "data_type faill in attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                        return;
                                    }
                                }
                            }
                            if(haveAttribute === 0){
                                $scope.massageCompare = "None Attribute "+ teacherResult[i].problem_analysis[j].attributes[y].name;
                                return;
                            }
                        }
                        for(y=0 ; y< teacherResult[i].problem_analysis[j].methods.length ; y++){
                            var haveMethod = 0
                            for(z=0 ; z<studentResult[i].problem_analysis[x].methods.length ; z++){
                                if(teacherResult[i].problem_analysis[j].methods[y].name ===studentResult[i].problem_analysis[x].methods[z].name){
                                    haveMethod++
                                    if(teacherResult[i].problem_analysis[j].methods[y].access_modifier !== studentResult[i].problem_analysis[x].methods[z].access_modifier){
                                        $scope.massageCompare = "access_modifier faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].non_access_modifier !== studentResult[i].problem_analysis[x].methods[z].non_access_modifier){
                                        $scope.massageCompare = "non_access_modifier faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].return_type !== studentResult[i].problem_analysis[x].methods[z].return_type){
                                        $scope.massageCompare = "return_type faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        return;
                                    }if(teacherResult[i].problem_analysis[j].methods[y].parameter !== studentResult[i].problem_analysis[x].methods[z].parameter){
                                        $scope.massageCompare = "parameter faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name+"("+teacherResult[i].problem_analysis[j].methods[y].parameter+")";
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].recursive !== studentResult[i].problem_analysis[x].methods[z].recursive){
                                        $scope.massageCompare = "recursive faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        return;
                                    }
                                    if(teacherResult[i].problem_analysis[j].methods[y].loop !== studentResult[i].problem_analysis[x].methods[z].loop){
                                        $scope.massageCompare = "loop faill in methods "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                        return;
                                    }
                                }
                            }
                            if(haveMethod === 0){
                                $scope.massageCompare = "None Method "+ teacherResult[i].problem_analysis[j].methods[y].name;
                                return;
                            }
                        }



                    }else{
                        var splitClassStudent = studentResult[i].problem_analysis[x].class.split(';');
                        if(splitClassTeacher[0] !== splitClassStudent[0] && splitClassTeacher[2] === splitClassStudent[2]){
                            $scope.massageCompare = "Access modifier Class fail";
                            return;
                        }
                    }
                }
                if(haveClass === 0){
                    $scope.massageCompare = "None class"+ splitClassTeacher[2] + "in require techer"
                    return;
                }
            }
        }

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

                    $scope.result.problem_files = response.data;
                    compareResult($scope.result.problem_files , $scope.result.problem.problem_files);

                    console.log($scope.result);
                },
                function(response){
                    // failure callback
                }
            );

    }
});

