
app.controller('viewMemberController',function($scope,viewMember,$localStorage,$http,$routeParams) {
    $scope.viewMember;
    $localStorage.course_id = $routeParams.course_id;
    getData($localStorage.user.token,$localStorage.course_id);
    function getData(token,course_id) {

        viewMember.getData(token,course_id).then(
            function(response){
                $scope.viewMember = response.data;
                //console.log($scope.viewMember);

            },
            function(response){
                // failure call back
            });

    }

});

