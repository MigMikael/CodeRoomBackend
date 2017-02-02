
app.controller('courseTeacherController',function($scope,$localStorage,$location, $http,courseTeacher,$routeParams) {
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;

    console.log($localStorage.course_id);
    getData($localStorage.user.token,$localStorage.course_id);

    function getData(token,course_id) {

        courseTeacher.getData(token,course_id).then(
            function(response){
                $scope.course = response.data;
                console.log($scope.course);

            },
            function(response){
                // failure call back
            });

    }


    $scope.openCarduser  = function(){
        if($scope.cardUser){
            document.getElementById("showCarduser").style.display = "none";


        }else {
            document.getElementById("showCarduser").style.display = "block";

        }
        $scope.cardUser = !$scope.cardUser;
    };
    $scope.go = function ( path ) {
        $location.path( path );
    };

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
    $scope.deleteLesson = function(lesson_id){

        $http.delete('/api/teacher/lesson/delete/'+lesson_id,{headders:{
                'Authorization_Token' : $localStorage.user.token
        }})
            .then(
                function(response){
                    console.log(response);
                    location.reload();


                },
                function(response){
                    // failure callback
                }
            );
    }


});


