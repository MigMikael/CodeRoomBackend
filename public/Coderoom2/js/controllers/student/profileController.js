
app.controller('profileStudentController',function($scope,$localStorage,$location, $http,$routeParams,profileStudent) {
    $scope.user = $localStorage.user;
    $scope.profileView = true;
    $scope.changePasswordView = false;
    $scope.editProfileView = false;
    $scope.oneAtATime = true;
    $scope.dataEditProfile;
    getData($localStorage.user.token,$localStorage.user.id);

    function getData(token,user_id) {

        profileStudent.getData(token,user_id).then(
            function(response){

                $scope.dataProfile = addPathimg(response.data);
                $scope.dataEditProfile = $scope.dataProfile;
                    console.log($scope.dataProfile);

            },
            function(response){
                // failure call back
            });

    }
    function addPathimg(data){
        data.image = "http://localhost:8000/api/image/"+data.image;
        return data;
    }
    $scope.changeView = function(view){

        if(view === "profile"){
            $scope.profileView = true;
            $scope.changePasswordView = false;
            $scope.editProfileView = false;

        }else if(view === "changePassword"){
            $scope.profileView = false;
            $scope.changePasswordView = true;
            $scope.editProfileView = false;


        }else if(view === "editProfile"){
            $scope.editProfileView = true;
            $scope.profileView = false;
            $scope.changePasswordView = false;
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
    };

    $scope.editProfile = function(){
        $http.post('/api/student/profile/edit', $scope.dataEditProfile,{headers:{
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
    };
    $scope.massageChangePassword;
    $scope.dataPassword = {
      student_id:$localStorage.user.id,
    };
    this.comparePassword = function () {
        if (angular.equals($scope.dataPassword.newPassword, $scope.dataPassword.confirmPassword)) {
            $scope.changePassword.confirmpassword.$setValidity('matchValidate', true);
        } else {
            $scope.changePassword.confirmpassword.$setValidity('matchValidate', false);
        }
    };
    $scope.submitChangepassword = function(){

            $http.post('/api/student/change_password', $scope.dataPassword,{headers:{
                    'Authorization_Token' : $localStorage.user.token
                }})
                .then(
                    function(response){
                        if(response.data.msg === "password is incorrect"){
                            $scope.massageChangePassword = "Old password incorrect";
                        }else{

                            location.reload();
                        }

                    },
                    function(response){
                        // failure callback
                    }
                );


    }





});



