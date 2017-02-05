
app.controller('readAnnouncementteacherController',function($scope,$localStorage,$http, $location,$rootScope,$routeParams,announcementStudentTeacher) {


    $scope.announcement;
    $rootScope.user = $localStorage.user;
    $localStorage.announcement_id = $routeParams.announcement_id;
    getData($localStorage.user.token,$localStorage.announcement_id);
    function getData(token,announcement_id) {

        announcementStudentTeacher.getData(token,announcement_id).then(
            function(response){

                $scope.announcement = response.data;
                console.log($scope.announcement);

            },
            function(response){
                // failure call back
            });

    }
    $scope.deleteAnnouncement = function(announcement_id){

        $http.delete('/api/teacher/announcement/delete/'+announcement_id,{headders:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    //console.log(response);
                    $location.path('/courseteacher/'+$localStorage.course_id);


                },
                function(response){
                    // failure callback
                }
            );
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

});

