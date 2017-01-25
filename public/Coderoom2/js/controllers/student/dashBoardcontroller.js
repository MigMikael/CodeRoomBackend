
app.controller('dashBoardstudentController',function($scope,$localStorage,dashBoardStudent) {
    console.log($localStorage.user);
    getData($localStorage.user.token);
    $scope.dashBoard;
    function getData(token) {

        dashBoardStudent.getData(token).then(
            function(response){
                $scope.dashBoard = response.data

            },
            function(response){
                // failure call back
            });

    }

});

