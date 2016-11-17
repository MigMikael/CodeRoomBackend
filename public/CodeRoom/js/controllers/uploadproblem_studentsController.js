app.controller('uploadproblem_studentsController',function($scope, $sce, $http, Upload, $timeout,$stateParams,lesson_students,$rootScope,$localStorage) {
    $scope.isNav = false;
    $scope.isAlert = false;

     function openNav(){
        if($scope.isNav){
            document.getElementById("hover").style.width = "0";

        }else {
            document.getElementById("hover").style.width = "100%";
        }
        $scope.isNav = !$scope.isNav;
    };
    $scope.openNavView  = function(){
        if($scope.isNav){
            document.getElementById("hover").style.width = "0";

        }else {
            document.getElementById("hover").style.width = "100%";
        }
        $scope.isNav = !$scope.isNav;
    };

    //ace
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/eclipse");
    editor.getSession().setMode("ace/mode/java");

    $scope.course_name = $stateParams.course_name;
    $scope.detail_problem;
    $localStorage.lesson_id_student = $stateParams.lesson_id;
    $scope.files;
    getLesson();
    //manageData()




    function getLesson() {

        lesson_students.getlesson_students($localStorage.lesson_id_student)
            .success(function (data) {
                $scope.lesson = data;
                manageData();
               //checkSucsessproblem();
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });
    };



    function manageData(){
        $scope.problems = [];

        for(i in $scope.lesson.problem){

            var class1 = [];

            for(j in $scope.lesson.problem[i].problemAnalysis){
                var arrayAttibute = [];
                var arrayMethod = [];
                var arrayConstructor = [];

                var splitClass = $scope.lesson.problem[i].problemAnalysis[j].class.split(";");
                if(splitClass[1]==="null"){
                    splitClass[1] ="-"
                }

                splitClass1 = ["Class" , splitClass[0],splitClass[1],"-",splitClass[2],"-",$scope.lesson.problem[i].problemAnalysis[j].student_class_score,$scope.lesson.problem[i].problemAnalysis[j].class_score]
                console.log(splitClass1);


                var setPackage = ["Package", "-" , "-" , "-" , $scope.lesson.problem[i].problemAnalysis[j].package,"-" , $scope.lesson.problem[i].problemAnalysis[j].student_package_score, $scope.lesson.problem[i].problemAnalysis[j].package_score];
                //console.log(setPackage);

                //console.log(setPackage);


                var setEnclose = ["Enclose","-","-","-", $scope.lesson.problem[i].problemAnalysis[j].enclose,"-", $scope.lesson.problem[i].problemAnalysis[j].student_enclose_score , $scope.lesson.problem[i].problemAnalysis[j].enclose_score];
                //console.log(setEnclose);

                var splitConstructor1 = $scope.lesson.problem[i].problemAnalysis[j].constructor.split("|");
                var splitConstructor1_score = $scope.lesson.problem[i].problemAnalysis[j].constructor_score.split("|");
                console.log(splitConstructor1_score);
                var splitConstructor1_score_student;
                if($scope.lesson.problem[i].problemAnalysis[j].student_constuctor_score === "0"){
                    splitConstructor1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_constuctor_score;

                }else{
                    splitConstructor1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_constuctor_score.split("|");
                }
                for(var z in splitConstructor1){
                    if(splitConstructor1[z]!== ""){
                        var splitConstructor2 = splitConstructor1[z].split(";");
                        splitConstructor2[0] = "Constructor";
                        splitConstructor2.splice(2,0,"-");
                        splitConstructor2.splice(3,0,"-");
                        //console.log(splitConstructor2);
                        if(splitConstructor1_score_student === "0"){
                            splitConstructor2.push(splitConstructor1_score_student);
                        }else{
                            var splitConstructor2_score_student  = splitConstructor1_score_student[z].split(";");
                            splitConstructor2.push(splitConstructor2_score_student[1]);
                        }
                        if(splitConstructor1_score[z] !== ""){
                            var splitConstructor2_score = splitConstructor1_score[z].split(";");
                            splitConstructor2.push(splitConstructor2_score[1]);
                        }
                        arrayConstructor.push(splitConstructor2);
                       //console.log(splitConstructor2);
                    }
                }


                var splitAttribute1 = $scope.lesson.problem[i].problemAnalysis[j].attribute.split("|");
                var splitAttribute1_score = $scope.lesson.problem[i].problemAnalysis[j].attribute_score.split("|");
                var splitAttribute1_score_student;
                if($scope.lesson.problem[i].problemAnalysis[j].student_attribute_score === "0"){
                    splitAttribute1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_attribute_score;
                }else{
                    splitAttribute1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_attribute_score.split("|");
                }
                for(var z in splitAttribute1){
                    if(splitAttribute1[z]!== ""){
                        var splitAttribute2 = splitAttribute1[z].split(";");

                        splitAttribute2[0] = "Attribute";
                        if(splitAttribute2[2]==="null"){
                            splitAttribute2[2] = "-";
                        }

                        splitAttribute2.push("-");
                        //console.log(splitAttribute2);
                        if(splitAttribute1_score_student === "0"){
                            splitAttribute2.push(splitAttribute1_score_student);
                        }else{
                            var splitAttribute2_score_student  = splitAttribute1_score_student[z].split(";");
                            splitAttribute2.push(splitAttribute2_score_student[1]);
                        }

                        if(splitAttribute1_score[z] !== ""){
                            var splitAttribute2_score = splitAttribute1_score[z].split(";");
                            splitAttribute2.push(splitAttribute2_score[1]);
                        }

                        arrayAttibute.push(splitAttribute2);
                        //console.log(splitAttribute2);
                    }
                }

                //waite for score students index 6
                var splitMethod1 = $scope.lesson.problem[i].problemAnalysis[j].method.split("|");
                var splitMethod1_socre = $scope.lesson.problem[i].problemAnalysis[j].method_score.split("|");
                var splitMethod1_score_student;
                if($scope.lesson.problem[i].problemAnalysis[j].student_method_score === "0"){

                    splitMethod1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_method_score;
                }else{

                    splitMethod1_score_student = $scope.lesson.problem[i].problemAnalysis[j].student_method_score.split("|");
                }

                for(var z in splitMethod1){
                    if(splitMethod1[z] !== ""){
                        var splitMethod2 = splitMethod1[z].split(";");
                        splitMethod2[0] = "Method";
                        if(splitMethod2[2]==="null"){
                            splitMethod2[2] = "-";
                        }
                        //console.log(splitMethod2);
                        if(splitMethod1_score_student==="0"){
                            splitMethod2.push(splitMethod1_score_student);
                        }else{
                            var splitMethod2_score_student = splitMethod1_score_student[z].split(";");
                            splitMethod2.push(splitMethod2_score_student[1]);
                        }

                        if(splitMethod1_socre[z] !== ""){
                            var splitMethod2_score = splitMethod1_socre[z].split(";");

                            splitMethod2.push(splitMethod2_score[1]);
                        }
                        //console.log(splitMethod2);

                        arrayMethod.push(splitMethod2);
                    }

                }
                class1.push({
                    class:splitClass1,
                    package:setPackage,
                    enclose:setEnclose,
                    constructors:arrayConstructor,
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
                $scope.probInpage.class = $scope.lesson.problem[i].manyClass;
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
                $scope.probInpage.class = $scope.lesson.problem[i].manyClass;
                //console.log($scope.probInpage);
                openNav();
                break;
            }
        }

    };

    function checkSucsessproblem(data){

        for(i in data){
            for(j in data[i].manyClass){

                if(data[i].manyClass[j].class[5]!==data[i].manyClass[j].class[6]){
                    setProblem(data[i].prob_id);
                    console.log(data[i].prob_id);
                    return;
                }
                if(data[i].manyClass[j].enclose[5]!==data[i].manyClass[j].enclose[6]){
                    setProblem(data[i].prob_id);
                    console.log(data[i].prob_id);
                    return;
                }
                if(data[i].manyClass[j].package[5]!==data[i].manyClass[j].package[6]){
                    setProblem(data[i].prob_id);
                    console.log(data[i].prob_id);
                    return;
                }

                for(z in data[i].manyClass[j].constructors){
                    if(data[i].manyClass[j].constructors[z][5] !== data[i].manyClass[j].constructors[z][6]){
                        setProblem(data[i].prob_id);
                        console.log(data[i].prob_id);
                        return;
                    }
                }

                for(z in data[i].manyClass[j].attributes){
                    if(data[i].manyClass[j].attributes[z][5] !== data[i].manyClass[j].attributes[z][6]){
                      setProblem(data[i].prob_id);
                        console.log(data[i].prob_id);
                        return;
                    }
                }
                for(z in data[i].manyClass[j].methods){
                    if(data[i].manyClass[j].methods[z][5] !== data[i].manyClass[j].methods[z][6]){
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

    $scope.readFiles = function(){

        if($scope.files != null){
                var file = $scope.files[0];



                    var reader = new FileReader();

                    reader.onload = function(e) {
                        console.log(reader.result);
                    }
                    reader.readAsText(file);


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

