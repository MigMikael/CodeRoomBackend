
app.controller('addStudentSortController',function($scope,$localStorage,$routeParams,$http,$location) {
    $scope.openCarduser  = function(){
        if($scope.cardUser){
            document.getElementById("showCarduser").style.display = "none";


        }else {
            document.getElementById("showCarduser").style.display = "block";

        }
        $scope.cardUser = !$scope.cardUser;
    };
    $scope.students = {
        allStudent:[],
        "studentCourse": [
            {
                "id": 1,
                "student_id": "07560550",
                "name": "Chanachai Puttaruksa",
                "image": "http://localhost:8000/api/image/25",
                "created_at": "2016-11-27 16:02:32",
                "updated_at": "2016-11-27 16:02:32",
                "username": "MigMikael",
                "pivot": {
                    "course_id": 1,
                    "student_id": 1,
                    "status": "active",
                    "progress": 69
                }
            },
            {
                "id": 2,
                "student_id": "07560445",
                "name": "นันทิพัฒน์ พลบดี",
                "image": "http://localhost:8000/api/image/26",
                "created_at": "2016-11-27 16:02:32",
                "updated_at": "2016-11-27 16:02:32",
                "username": "Manny",
                "pivot": {
                    "course_id": 1,
                    "student_id": 2,
                    "status": "active",
                    "progress": 71
                }
            }
        ]
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



