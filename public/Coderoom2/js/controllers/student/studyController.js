
app.controller('studyController',function($scope) {
    $scope.isNav = false;


    function openNav(){
        if($scope.isNav){
            document.getElementById("hover").style.display = "none";


        }else {
            document.getElementById("hover").style.display = "block";

        }
        $scope.isNav = !$scope.isNav;
    };
    $scope.openNavView  = function(){
        if($scope.isNav){
            document.getElementById("hover").style.display = "none";


        }else {
            document.getElementById("hover").style.display = "block";

        }
        $scope.isNav = !$scope.isNav;
    };

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/eclipse");
    editor.getSession().setMode("ace/mode/java");


});

