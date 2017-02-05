
app.controller('profileAdminController',function($scope,$localStorage,$location, $http,$routeParams) {
    $scope.user = $localStorage.user;
    $scope.profile = true;
    $scope.changePassword = false;
    $scope.editProfile = false;


    //getData($localStorage.user.token,$localStorage.course_id);

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
    $scope.changeView = function(view){
        if(view === "profile"){
            $scope.profile = true;
            $scope.changePassword = false;
            $scope.editProfile = false;
        }else if(view === "changePassword"){
            $scope.profile = false;
            $scope.changePassword = true;
            $scope.editProfile = false;
        }else if(view === "editProfile"){
            $scope.editProfile = true;
            $scope.profile = false;
            $scope.changePassword = false;
        }
    };
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


    $scope.oneAtATime = true;

    $scope.groups = [
        {
            title: 'Comprogramming I',
            content: 'Dynamic Group Body - 1'
        },
        {
            title: 'Comprogramming II',
            content: 'Dynamic Group Body - 2'
        }
    ];


});



