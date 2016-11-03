
app.controller('profile_studentsController',function($scope,$stateParams,$rootScope,$localStorage,profile_students) {
    $scope.student;

    getStudent();




    function getStudent() {

        profile_students.getProfile_students($localStorage.student_id)
            .success(function (data) {
                $scope.student = addPath(data);
                console.log($scope.student);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }

    function addPath(data){
        data.image = "http://localhost:8000/api/image/" + data.image;
        for(i=0 ; i<data.badges.length ; i++){

            data.badges[i].image = "http://localhost:8000/api/image/"+ data.badges[i].image;
            console.log(data.badges[i].image);
        }
        return data;
    }






});
