
app.controller('uploadTeacherController', ['$scope','$http','Upload','$timeout', function($scope, $http, Upload, $timeout) {
    $scope.clickShowrequirement = 0;
    $scope.isFormproblem = true;
    $scope.isRequirment = false;
    $scope.requirment = [];
    $scope.teacherRequirement;
    /*$scope.teacherRequirement = [
        {
        "id": 9,
        "prob_id": 5,
        "class": "public;null;Runners",
        "package": "default package",
        "enclose": "null",
        "attribute": "1;default;static;int;round|2;default;static;float;time|",
        "method": "1;public;null;void;printTest;()|",
        "created_at": "2016-10-13 12:27:10",
        "updated_at": "2016-10-13 12:27:10",
        "code": ""
        },
        {
        "id": 10,
        "prob_id": 5,
        "class": "default;null;Runner",
        "package": "default package",
        "enclose": "Runners",
        "attribute": "1;default;static;int;no|2;default;null;int;speed|3;default;null;float;wasteTime|4;default;null;float;totalTime|",
        "method": "1;public;static;int;getNo;()|2;public;null;void;setNo;()|3;public;null;int;getSpeed;()|4;public;null;void;setSpeed;()|5;public;null;float;getWasteTime;()|6;public;null;void;setWasteTime;()|7;public;null;float;getTotalTime;()|8;public;null;void;setTotalTime;()|",
        "created_at": "2016-10-13 12:27:10",
        "updated_at": "2016-10-13 12:27:10",
        "code": ""
        }
    ];
     */


    var setShow = function(){
        $scope.isFormproblem = !$scope.isFormproblem;
        $scope.isRequirment = !$scope.isRequirment;
    };

    var showRequirement = function(){
        var countMethod = 0;
        if(countMethod !== $scope.clickShowrequirement){
            return;
        }
        $scope.clickShowrequirement +=1;
        for(var x in $scope.teacherRequirement){
            var objprob_id;
            var objClass = [];
            var objEnclose = [];
            var objPackage = [];
            var objConstructor = [];
            var objAttribute = [];
            var objMethod = [];
            for(var y in $scope.teacherRequirement[x]){
                if(y==="prob_id"){
                    objprob_id = $scope.teacherRequirement[x][y];
                }
                else if(y==="class"){
                    var classs = $scope.teacherRequirement[x][y].split(';');
                    //console.log("Class "+classs[0]+" "+classs[1]);
                    if(classs[1]==="null"){
                        classs[1] = "-";
                    }
                    objClass = ["Class",classs[0],classs[1],classs[2],""];


                }
                else if(y==="enclose") {
                    objEnclose = ["Enclose",$scope.teacherRequirement[x][y],""];
                }
                else if(y==="package") {
                    objPackage = ["Package",$scope.teacherRequirement[x][y],""];
                }
                else if(y==="constructor") {

                }
                else if(y==="attribute"){
                    var attributes = $scope.teacherRequirement[x][y].split('|');
                    for(attribute in attributes){
                        var subattributes = attributes[attribute].split(';');
                        //console.log(attributes[attribute]);
                        if(attributes[attribute]!== ""){
                           // console.log("Attribute "+subattributes[1]+" "+subattributes[2]+" "+subattributes[3]);
                            if(subattributes[2]==="null"){
                                subattributes[2] = "-";
                            }
                            objAttribute.push(["Attribute",subattributes[1],subattributes[2],subattributes[3],subattributes[4],""]);

                        }
                    }
                }else if(y==="method"){
                    var methods = $scope.teacherRequirement[x][y].split('|');
                    for(method in methods){
                        var submethods = methods[method].split(';');
                        //console.log(methods[method]);
                        if(methods[method]!== ""){
                            //console.log("Method "+submethods[1]+" "+submethods[2]+" "+submethods[3]+" "+submethods[4]);
                            if(submethods[2]==="null"){
                                submethods[2] = "-";
                            }
                            objMethod.push(["Method",submethods[1],submethods[2],submethods[3],submethods[4],submethods[5],""]) ;

                        }
                    }
                }
            }

            $scope.requirment.push(
                {
                    prob_id:objprob_id,
                    class:objClass,
                    package:objPackage,
                    encolse:objEnclose,
                    constructor:objConstructor,
                    attribute:objAttribute,
                    method:objMethod,

                }
            );
        }
        console.log($scope.requirment);
    };
    //upload
    $scope.uploadFiles = function(file) {
        //setShow();
        //showRequirement();
        
        file.upload = Upload.upload({
            url: '/problemfile/add',
            data: {filename: $scope.filename,package: $scope.package, lesson_id: $scope.lesson_id,filefield: file},
        });
        
        file.upload.then(function (response) {
            $timeout(function () {
                setShow();
                file.result = response.data;
                $scope.teacherRequirement = response.data;
                console.log($scope.teacherRequirement);
                showRequirement();
            });
        }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };

    $scope.calcuratePoint = function(){
    $scope.totolPoint =0;

        for(var i in $scope.requirment){
            for(var j in $scope.requirment[i]){
                //console.log($scope.requirment[i][j]);
                if(j==="class"){
                   if($scope.requirment[i][j][4]===""){
                       $scope.totolPoint = $scope.totolPoint;

                   }else{
                       $scope.totolPoint += parseFloat($scope.requirment[i][j][4]);
                   }
                }
                else if(j==="package"){
                    if($scope.requirment[i][j][2]===""){
                        $scope.totolPoint = $scope.totolPoint;

                    }else{
                        $scope.totolPoint += parseFloat($scope.requirment[i][j][2]);
                    }
                }
                else if(j==="enclose"){
                    if($scope.requirment[i][j][2]===""){
                        $scope.totolPoint = $scope.totolPoint;

                    }else{
                        $scope.totolPoint += parseFloat($scope.requirment[i][j][2]);
                    }
                }
                else if(j==="constructor"){

                }
                else if(j==="attribute"){
                    for(var z in $scope.requirment[i][j]){
                        //console.log($scope.requirment[i][j][z]);
                        if($scope.requirment[i][j][z][5]===""){
                            $scope.totolPoint = $scope.totolPoint;
                        }else {
                            $scope.totolPoint += parseFloat($scope.requirment[i][j][z][5]);
                        }

                    }
                }else if(j==="method"){
                    for(var z in $scope.requirment[i][j]){
                        if($scope.requirment[i][j][z][6]===""){
                            $scope.totolPoint = $scope.totolPoint;
                        }else {
                            $scope.totolPoint += parseFloat($scope.requirment[i][j][z][6]);
                        }

                    }
                }
            }
        }
    };
    $scope.submitRequirment = function(){
        var res = $http.post('/problem_analysis/score', $scope.requirment);
        res.success(function(data, status, headers, config) {
            $scope.message2 = data;
            setShow();
            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };






}]);