
app.controller('viewMemberteacherController',function($scope,viewMemberTeacher,$localStorage,$http,$routeParams,$location) {
    $scope.viewMember;
    $scope.cardUser = false;
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;
    getData($localStorage.user.token,$localStorage.course_id);

    function getData(token,course_id) {

        viewMemberTeacher.getData(token,course_id).then(
            function(response){
                $scope.viewMember = addPathimage(response.data);
                console.log($scope.viewMember);

            },
            function(response){
                // failure call back
            });

    }
    function addPathimage(data){
        for(var i in data){
            if(i=="students"){
                for(j=0 ; j<data[i].length;j++){
                    data[i][j].image = "http://localhost:8000/api/image/"+data[i][j].image;
                }
            }else if(i=="teachers"){
                for(j=0 ; j<data[i].length;j++){
                    data[i][j].image = "http://localhost:8000/api/image/"+data[i][j].image;
                }
            }
        }
        return data;
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

    $scope.disableStudent = function(student_id){
        $http.get('/api/teacher/student/disable/'+student_id+"/"+$localStorage.course_id,{headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){

                    location.reload();
                },
                function(response){
                    // failure callback
                }
            );
    }
});

/**
 * Created by thanadej on 1/30/2017 AD.
 */
