app.controller('uploadController', ['$scope','$http','Upload','$timeout',function($scope, $http, Upload, $timeout) {
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


    $scope.test =
        [
            {
                submission_id: "4",
                class: "Wood;true",
                package: "default package;true",
                enclose: "HandleWood;false",
                attribute: "1;true|2;true|3;true",
                attribute_score: "1;10|2;10|3;10",
                method: "1;true|2;true|3;true|4;true|5;true|6;true",
                method_score: "1;10|2;0;|3;0|4;10|5;10|6;0",
                created_at: "2016-06-23 17:56:56",
                updated_at: "2016-06-23 17:56:56"
            },
            {
                submission_id: "4",
                class: "HandleWood;true",
                package: "default package;true",
                enclose: "none",
                attribute: "1;true|2;false",
                attribute_score: "1;10|2;10",
                method: "1;true",
                method_score: "1;10",
                created_at: "2016-06-23 18:02:43",
                updated_at: "2016-06-23 18:02:43"
            }
        ];

    $scope.checkPropriety = function(){
        $scope.alert = "";
        for(var i in $scope.test){
            for(var j in $scope.test[i]){
                if(j==="class"){
                    var splitClass = $scope.test[i][j].split(';');
                    if(splitClass[1]==="false"){
                        $scope.alert = "Fail Class "+splitClass[0];
                        return;
                    }
                }else if(j==="package"){
                    var splitPackage = $scope.test[i][j].split(';');
                    if(splitPackage[1]==="false"){
                        $scope.alert = "Fail Package "+splitPackage[0];
                        return;
                    }
                }else if(j==="enclose"){
                var splitEnclose = $scope.test[i][j].split(';');
                if(splitEnclose[1]==="false"){
                    $scope.alert = "Fail Enclose "+splitEnclose[0];
                    return;
                }
                }else if(j==="attribute"){
                    var splitAttribute = $scope.test[i][j].split('|');
                    for(var z in splitAttribute){
                       var subSplitattribute = splitAttribute[z].split(';');
                        if(subSplitattribute[1]==="false"){
                            $scope.alert = "Fail Attribute "+subSplitattribute[0];
                            return;
                        }
                    }
                }else  if(j==="method"){
                    var splitMethod = $scope.test[i][j].split('|');
                    for(var z in splitMethod){
                        var subSplitmethod = splitMethod[z].split(';');
                        if(subSplitmethod[1]==="false"){
                            $scope.alert = "Fail Method "+subSplitmethod[0];
                            return;
                        }
                    }
                }
            }
        }
        if($scope.alert===""){
            $scope.alert = "Success"
            return;
        }
        return;
    };
    //ace

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

    $scope.onLoad2 = function() {
        $scope.Model = {
            Scripting: [
                "(function () {",
                "    angular.module('ui.blur', [])",
                "        .directive('ngBlurValidation', [ function () {",
                "            return {",
                "                restrict: 'A',",
                "                link: function (scope, element, attributes, form) {",
                "                    element.on('blur', function(){",
                "                        element.valid();",
                "                    });",
                "                }",
                "            };",
                "        }]);",
                "})();"
            ]
        }
        //$scope.$apply()
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


}]);

