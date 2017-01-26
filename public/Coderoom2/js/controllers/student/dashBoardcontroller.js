
app.controller('dashBoardstudentController',function($scope,$localStorage,dashBoardStudent,$http, $location) {

    getData($localStorage.user.token);
    $scope.dataDashboard;
    $scope.user = $localStorage.user;
    function getData(token) {

        dashBoardStudent.getData(token).then(
            function(response){
                $scope.dataDashboard = deleteCourse(response.data);
                console.log($scope.dataDashboard);

            },
            function(response){
                // failure call back
            });

    }
    function deleteCourse(data){

        for(i=0 ; i<data.student.courses.length ; i++){

            for(j=0 ; j<data.course.length ;j++){
                if(data.student.courses[i].id===data.course[j].id){

                    data.course.splice(j,1);


                }
            }
        }
        return data;
    }
    $scope.go = function ( path ) {
        $location.path( path );
    };

});

