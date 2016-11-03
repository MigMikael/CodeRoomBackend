
app.controller('liststudent_teachersController',function($scope,liststudent_student,$stateParams,$rootScope,$localStorage) {
    $scope.students;

    getStudent_list();




    function getStudent_list() {

        liststudent_teachers.getListstudent_teachers($localStorage.course_id_student)
            .success(function (data) {
                $scope.students = data;
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }




});

