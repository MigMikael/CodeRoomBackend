
app.controller('uploadTeacherController', ['$scope','$http','Upload','$timeout', function($scope, $http, Upload, $timeout) {
    $scope.clickShowrequirement = 0;
    $scope.isFormproblem = true;
    $scope.isRequirment = false;
    $scope.requirment = [];
    $scope.teacherRequirement;


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
            var objAttribute = [];
            var objMethod = [];
            for(var y in $scope.teacherRequirement[x]){
                if(y==="prob_id"){
                    objprob_id = $scope.teacherRequirement[x][y];
                }
                else if(y==="class"){
                    var classs = $scope.teacherRequirement[x][y].split(';');
                    //console.log("Class "+classs[0]+" "+classs[1]);
                    objClass = [classs[0],classs[1]];


                }else if(y==="attribute"){
                    var attributes = $scope.teacherRequirement[x][y].split('|');
                    for(attribute in attributes){
                        var subattributes = attributes[attribute].split(';');
                        //console.log(attributes[attribute]);
                        if(attributes[attribute]!== ""){
                           // console.log("Attribute "+subattributes[1]+" "+subattributes[2]+" "+subattributes[3]);
                            objAttribute.push([subattributes[1],subattributes[2],subattributes[3],""]);

                        }
                    }
                }else if(y==="method"){
                    var methods = $scope.teacherRequirement[x][y].split('|');
                    for(method in methods){
                        var submethods = methods[method].split(';');
                        //console.log(methods[method]);
                        if(methods[method]!== ""){
                            //console.log("Method "+submethods[1]+" "+submethods[2]+" "+submethods[3]+" "+submethods[4]);
                            objMethod.push([submethods[1],submethods[2],submethods[3],submethods[4],""]) ;

                        }
                    }
                }
            }

            $scope.requirment.push(
                {
                    prob_id:objprob_id,
                    class:objClass,
                    attribute:objAttribute,
                    method:objMethod,

                }
            );
        }
    };
    //upload
    $scope.uploadFiles = function(file) {
        file.upload = Upload.upload({
            url: '/problemfile/add',
            data: {filename: $scope.filename,pacekage: $scope.package, filefield: file},
        });

        file.upload.then(function (response) {
            $timeout(function () {
                setShow();
                file.result = response.data;
                $scope.teacherRequirement = response.data;
                console.log(response.data);
                console.log(file.name);
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
                if(j==="attribute"){
                    for(var z in $scope.requirment[i][j]){
                        //console.log($scope.requirment[i][j][z]);
                        if($scope.requirment[i][j][z][3]===""){
                            $scope.totolPoint = $scope.totolPoint;
                        }else {
                            $scope.totolPoint += parseFloat($scope.requirment[i][j][z][3]);
                        }

                    }
                }else if(j==="method"){
                    for(var z in $scope.requirment[i][j]){
                        if($scope.requirment[i][j][z][4]===""){
                            $scope.totolPoint = $scope.totolPoint;
                        }else {
                            $scope.totolPoint += parseFloat($scope.requirment[i][j][z][4]);
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

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };






}]);