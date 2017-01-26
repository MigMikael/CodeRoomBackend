
app.controller('studyController',function($scope,studyStudent,$localStorage,$http,$routeParams,$location) {
    $scope.isNav = false;
    $scope.study;
    $scope.user = $localStorage.user;
    $localStorage.lesson_id = $routeParams.lesson_id;
    getData($localStorage.user.token,$localStorage.lesson_id);

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
    editor.setTheme("ace/theme/netbeans");
    editor.getSession().setMode("ace/mode/java");




    function getData(token,lesson_id) {

        studyStudent.getData(token,lesson_id).then(
            function(response){
                $scope.study = response.data;
                console.log($scope.study);

            },
            function(response){
                // failure call back
            });

    }
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

});

