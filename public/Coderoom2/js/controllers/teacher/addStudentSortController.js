
app.controller('addStudentSortController',function($scope,$localStorage,$routeParams,$http,$location,addStudentteacher) {
    $localStorage.course_id = $routeParams.course_id;
    $scope.user = $localStorage.user;
    getData($localStorage.user.token,$localStorage.course_id);
    $scope.addStudentsort = {};

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

    function getData(token,course_id) {

        addStudentteacher.getData(token,course_id).then(
            function(response){
                console.log(response.data);
                $scope.addStudentsort = dupicateStudent(response.data);

            },
            function(response){
                // failure call back
            });

    }
    function dupicateStudent(data){
        for(i=0 ; i<data.students_course.length ; i++){

            for(j=0 ; j<data.students.length ;j++){
                if(data.students_course.id===data.students.id){
                    data.students.splice(j,1);


                }
            }
        }
        return data;
    }
    $scope.logout = function () {

        $http.get('/logout', {headers:{
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

    $scope.addStudent = function(){

        $http.post('/', $scope.addStudentsort,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    $location.path('/viewMemberteacher/'+$localStorage.course_id);
                },
                function(response){
                    // failure callback
                }
            );
    }
});



