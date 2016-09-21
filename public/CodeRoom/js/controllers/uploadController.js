app.controller('uploadController',function($scope, $sce, $http, Upload, $timeout,$stateParams,lesson,$rootScope,$localStorage) {
    $scope.isNav = false;
    $scope.isAlert = false;

     function openNav(){
        if($scope.isNav){
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";

        }else {
            document.getElementById("mySidenav").style.width = "350px";
            document.getElementById("main").style.marginLeft = "350px";
        }
        $scope.isNav = !$scope.isNav;
    };
    $scope.openNavView  = function(){
        if($scope.isNav){
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";

        }else {
            document.getElementById("mySidenav").style.width = "350px";
            document.getElementById("main").style.marginLeft = "350px";
        }
        $scope.isNav = !$scope.isNav;
    };

    //ace
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/eclipse");
    editor.getSession().setMode("ace/mode/java");

    $scope.course_name = $stateParams.course_name;

    $localStorage.lesson_id = $stateParams.lesson_id;




    //getLesson();

    $scope.lesson = {
        lesson_name: "Array",
        problem: [
            {
            prob_id: 4,
            name: "Runners",
            timelimit: 1,
            memorylimit: 32,
            lesson_id: 7,
            problemfile: "http://localhost:8000/problemfile/getQuestion/4",
            problemAnalysis: [
                {
                class: "null;null",
                class_score: 0,
                package: "",
                package_score: 0,
                enclose: "null",
                enclose_score: 0,
                attribute: "1;private;String;man|2;private;String;au|",
                attribute_score: "1;5|2;5",
                method: "1;default;void;test_print;()2;public;void;printV1;()",
                method_score: "1;10|2;10",
                student_attribute_score: "1;5|2;5|",
                student_method_score: "1;10|2;10|"
                },
                {
                class: "default;Chair",
                class_score: 0,
                package: "",
                package_score: 0,
                enclose: "Test",
                enclose_score: 0,
                attribute: "1;default;int;x|",
                attribute_score: "1;20",
                method: "",
                method_score: "",
                student_attribute_score: "1;20|",
                student_method_score: "1;0|"
                }
            ]
            }, {
            prob_id: 5,
            name: "Runners",
            timelimit: 1,
            memorylimit: 32,
            lesson_id: 7,
            problemfile: "http://localhost:8000/problemfile/getQuestion/5",
            problemAnalysis: [{
                class: "null;null",
                class_score: 0,
                package: "",
                package_score: 0,
                enclose: "null",
                enclose_score: 0,
                attribute: "1;private;String;man|2;private;String;au|",
                attribute_score: "1;44|2;55",
                method: "1;default;void;test_print;()2;public;void;printV1;()",
                method_score: "1;66|2;77",
                student_attribute_score: "1;44|2;55|",
                student_method_score: "1;66|2;77|"
            }, {
                class: "default;Chair",
                class_score: 0,
                package: "",
                package_score: 0,
                enclose: "Test",
                enclose_score: 0,
                attribute: "1;default;int;x|",
                attribute_score: "1;50",
                method: "",
                method_score: "",
                student_attribute_score: "1;50|",
                student_method_score: ""
            }]
        }, {
            prob_id: 6,
            name: "Runners",
            timelimit: 1,
            memorylimit: 32,
            lesson_id: 7,
            problemfile: "http://localhost:8000/problemfile/getQuestion/6",
            problemAnalysis: [{
                class: "null;null",
                class_score: 0,
                package: "",
                package_score: 0,
                enclose: "null",
                enclose_score: 0,
                attribute: "1;static;int;round|2;static;float;time|",
                attribute_score: "1;10|2;10",
                method: "1;public;void;printTest;()",
                method_score: "1;20|",
                student_attribute_score: "1;0|2;0|",
                student_method_score: "1;20|"
            }, {
                class: "default;Runner",
                class_score: 0,
                package: "",
                package_score: 0,
                enclose: "Runners",
                enclose_score: 0,
                attribute: "",
                attribute_score: "",
                method: "",
                method_score: "",
                student_attribute_score: "",
                student_method_score: ""
            }]
        }, {
            prob_id: 7,
            name: "Runners",
            timelimit: 1,
            memorylimit: 32,
            lesson_id: 7,
            problemfile: "http://localhost:8000/problemfile/getQuestion/7",
            problemAnalysis: []
        }]
    };





    function getLesson() {

        lesson.getLesson($localStorage.lesson_id)
            .success(function (data) {
                $scope.lesson = data;



                //checkSucsessproblem();

            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    };


    manageData();
    function manageData(){
        $scope.problems = [];

        for(i in $scope.lesson.problem){

            var class1 = [];

            for(j in $scope.lesson.problem[i].problemAnalysis){
                var arrayAttibute = [];
                var arrayMethod = [];

                var splitClass = $scope.lesson.problem[i].problemAnalysis[j].class.split(";");
                splitClass.push($scope.lesson.problem[i].problemAnalysis[j].class_score);



                var setPackage = [];
                setPackage.push($scope.lesson.problem[i].problemAnalysis[j].package);
                setPackage.push($scope.lesson.problem[i].problemAnalysis[j].package_score);

                //console.log(setPackage);

                var setEnclose = [];
                setEnclose.push($scope.lesson.problem[i].problemAnalysis[j].enclose);
                setEnclose.push($scope.lesson.problem[i].problemAnalysis[j].enclose_score);


                var splitAttribute1 = $scope.lesson.problem[i].problemAnalysis[j].attribute.split("|");
                var splitAttribute1_score = $scope.lesson.problem[i].problemAnalysis[j].attribute_score.split("|");
                var splitAttribute1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_attribute_score.split("|");
                for(var z in splitAttribute1){
                    if(splitAttribute1[z]!== "" && splitAttribute1_score_student[z]!==""){
                        var splitAttribute2 = splitAttribute1[z].split(";");
                        var splitAttribute2_score_student = splitAttribute1_score_student[z].split(";");
                        splitAttribute2.push(splitAttribute2_score_student[1]);
                        var splitAttribute2_score = splitAttribute1_score[z].split(";");
                        splitAttribute2.push(splitAttribute2_score[1]);
                        arrayAttibute.push(splitAttribute2);
                    }
                }


                var splitMethod1 = $scope.lesson.problem[i].problemAnalysis[j].method.split("()");
                var splitMethod1_socre = $scope.lesson.problem[i].problemAnalysis[j].method_score.split("|");
                var splitMethod1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_method_score.split("|");
                for(var z in splitMethod1){
                    if(splitMethod1[z] !== "" && splitMethod1_score_student[z] !== ""){
                        var splitMethod2 = splitMethod1[z].split(";");
                        splitMethod2.pop();
                        var splitMethod2_score_student = splitMethod1_score_student[z].split(";");
                        splitMethod2.push(splitMethod2_score_student[1]);
                        var splitMethod2_score = splitMethod1_socre[z].split(";");
                        splitMethod2.push(splitMethod2_score[1]);
                        //console.log(splitMethod2);
                        arrayMethod.push(splitMethod2);
                    }

                }
                class1.push({
                    constructer:splitClass,
                    package:setPackage,
                    enclose:setEnclose,
                    attributes:arrayAttibute,
                    methods:arrayMethod
                })
            //console.log(class1);
            }
            //console.log(class1);
            $scope.problems.push({
                prob_id:$scope.lesson.problem[i].prob_id,
                prob_name:$scope.lesson.problem[i].name,
                manyClass:class1,
            });


        }
        //console.log($scope.problems);
        checkSucsessproblem($scope.problems);
    }

    function setProblem(prob_id){
        for(i in $scope.lesson.problem){
            if(prob_id===$scope.lesson.problem[i].prob_id){
                $localStorage.prob_id = $scope.lesson.problem[i].prob_id;
                $scope.probInpage = $scope.lesson.problem[i];

                $scope.probInpage.order = parseInt(i)+1;
                console.log($scope.probInpage);
                break;
            }
        }
    };
    $scope.setProblemView = function(prob_id){
        for(i in $scope.lesson.problem){
            if(prob_id===$scope.lesson.problem[i].prob_id){
                $localStorage.prob_id = $scope.lesson.problem[i].prob_id;
                $scope.probInpage = $scope.lesson.problem[i];
                $scope.probInpage.order = parseInt(i)+1;
                //console.log($scope.probInpage);
                openNav();
                break;
            }
        }

    };

    function checkSucsessproblem(data){

        for(i in data){
            for(j in data[i].manyClass){

                for(z in data[i].manyClass[j].attributes){
                    if(data[i].manyClass[j].attributes[z][4] !== data[i].manyClass[j].attributes[z][5]){
                      setProblem(data[i].prob_id);
                        console.log(data[i].prob_id);
                        return;
                    }
                }
                for(z in data[i].manyClass[j].methods){
                    if(data[i].manyClass[j].methods[z][4] !== data[i].manyClass[j].methods[z][5]){
                        setProblem(data[i].prob_id);
                        return;
                    }
                }

            }
        }

    };






    //checkrespont
    $scope.checkPropriety = function(){
        $scope.alert = {
            massage:"",
            status:""
        };
        for(var i in $scope.test){
            for(var j in $scope.test[i]){
                if(j==="class"){
                    var splitClass = $scope.test[i][j].split(';');
                    if(splitClass[1]==="null"){
                        $scope.alert.massage = "Don't Have Class "+splitClass[0];
                        $scope.alert.status = splitClass[1];
                        return;
                    }
                    else if(splitClass[1]==="false"){
                        $scope.alert.massage = "Fail Class "+splitClass[0];
                        $scope.alert.status = splitClass[1];
                        return;
                    }
                }else if(j==="package"){
                    var splitPackage = $scope.test[i][j].split(';');
                    if(splitPackage[1]==="null"){
                        $scope.alert.massage = "Don't have Package "+splitPackage[0];
                        $scope.alert.status = splitPackage[1];
                        return;
                    }
                    else if(splitPackage[1]==="false"){
                        $scope.alert.massage = "Fail Package "+splitPackage[0];
                        $scope.alert.status = splitPackage[1];
                        return;
                    }
                }else if(j==="enclose"){
                var splitEnclose = $scope.test[i][j].split(';');
                    if(splitEnclose[1]==="null"){
                        $scope.alert.massage = "Don't Enclose "+splitEnclose[0];
                        $scope.alert.status = splitEnclose[1];
                        return;
                    }
                    else if(splitEnclose[1]==="false"){
                        $scope.alert.massage = "Fail Enclose "+splitEnclose[0];
                        $scope.alert.status = splitEnclose[1];
                        return;
                    }
                }else if(j==="attribute"){
                    var splitAttribute = $scope.test[i][j].split('|');
                    for(var z in splitAttribute){
                       var subSplitattribute = splitAttribute[z].split(';');
                        if(subSplitattribute[1]==="null"){
                            $scope.alert.massage = "Don't have Attribute "+subSplitattribute[0];
                            $scope.alert.status = subSplitattribute[1];
                            return;
                        }
                        else if(subSplitattribute[1]==="false"){
                            $scope.alert.massage = "Fail Attribute "+subSplitattribute[0];
                            $scope.alert.status = subSplitattribute[1];
                            return;
                        }
                    }
                }else  if(j==="method"){
                    var splitMethod = $scope.test[i][j].split('|');
                    for(var z in splitMethod){
                        var subSplitmethod = splitMethod[z].split(';');
                        if(subSplitmethod[1]==="null"){
                            $scope.alert.massage = "Don't have Method "+subSplitmethod[0];
                            $scope.alert.status = subSplitmethod[1];
                            return;
                        }
                        else if(subSplitmethod[1]==="false"){
                            $scope.alert.massage = "Fail Method "+subSplitmethod[0];
                            $scope.alert.status = subSplitmethod[1];
                            return;
                        }
                    }
                }
            }
        }
        if($scope.alert.massage===""||$scope.alert.status===""){
            $scope.alert.massage = "Complete"
            $scope.alert.status = "complete"
            return;
        }
        return;
    };

    //demo mutiple ace
    $scope.Model = {
        Scripting: []
    };

    $scope.onLoad1 = function() {
        $scope.Model = {
            Scripting: [
                "(function () {",
                "    /**",
                "     * The drawer directive allows a bootstrap dropdown item to",
                "     * behave as a persistent drawer, only closing when the user",
                "     * clicks somewhere other than the drawer.",
                "     **/",
                "    angular.module('ui.bootstrap.drawer', [])",
                "        .directive('bootstrapDropdownDrawer', function () {",
                "        return {",
                "            restrict: 'A',",
                "            scope: {},",
                "            link: function (scope, element, attributes) {",
                "                element.on('click', function ($event) {",
                "                    if ($event.target.tagName !== 'A') {",
                "                        $event.preventDefault();",
                "                        $event.stopPropagation();",
                "                    }",
                "                });",
                "            }",
                "        };",
                "    });",
                "})();"
            ]
        }


    };




    //upload
    $scope.uploadFiles = function(file) {
        file.upload = Upload.upload({
            url: 'https://posttestserver.com/post.php',
            data: {file: file},
        });

        file.upload.then(function (response) {
            $timeout(function () {
                file.result = response.data;

            });
        }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };

    $scope.submitProblem = function(){

        var dataSubmitproblem = {
            user_id: $localStorage.student_id,
            prob_id: $localStorage.prob_id,
            code: editor.getValue(),
        };
        console.log(dataSubmitproblem);

        var res = $http.post('/submissions', dataSubmitproblem);
        res.success(function(data, status, headers, config) {

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };


});

