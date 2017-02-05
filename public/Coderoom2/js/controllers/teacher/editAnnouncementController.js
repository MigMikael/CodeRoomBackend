
app.controller('editAnnouncementteacherController',function($scope,$localStorage,$routeParams,$http,$location,announcementStudentTeacher) {
    $scope.user = $localStorage.user;

    getData($localStorage.user.token,$localStorage.announcement_id);

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

    $scope.announcement;
    function getData(token,announcement_id) {

        announcementStudentTeacher.getData(token,announcement_id).then(
            function(response){

                $scope.announcement  = response.data;
                console.log($scope.announcement);

            },
            function(response){
                // failure call back
            });

    }

    $scope.editAnnouncement = function(){
        $http.post('', $scope.announcement,{headders:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    $location.path('/readannouncementteacher/'+$$localStorage.announcement_id);
                },
                function(response){
                    // failure callback
                }
            );
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


/**
 * Created by thanadej on 2/4/2017 AD.
 */
