app.controller('uploadController',function($scope, $http, Upload, $timeout,$stateParams,lesson,getPDFproblem,$rootScope,$localStorage) {
    $scope.isNav = false;
    $scope.isAlert = false;

    $scope.openNav = function(){
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
    $scope.prob_id = 1;
    $localStorage.lesson_id = $stateParams.lesson_id;




    //getLesson();
    $scope.lesson_data = {
        problem:[
            {
                prob_id: 1,
                name: "IF",
                timelimit: 1,
                memorylimit: 32,
                lesson_id: 15
            },
            {
                prob_id: 2,
                name: "IF-ELSE",
                timelimit: 1,
                memorylimit: 32,
                lesson_id: 15
            }
        ],
        lesson_name: "คำสั่งเดียว คำสั่งเงือนไข และชุดคำสั่ง"
    };




    function getLesson() {

        lesson.getLesson($localStorage.lesson_id)
            .success(function (data) {
                $scope.lesson_data = data;
                getPDFproblem();
                //console.log($scope.lesson_data);
                //checkSucsessproblem();
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    };

    function checkSucsessproblem(){


    };

    function getPDFproblem() {

        getPDFproblem().getPDFproblem($scope.prob_id)
            .success(function (data){

                $scope.pdf_problem = data;
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    };
    $scope.changeProblem = function(problem_id){
        $scope.prob_id = problem_id;
        openNav();
        getPDFproblem();

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
            prob_id: $scope.prob_id,
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

