
app.controller('liststudent_studentsController',function($scope,liststudent_students,$stateParams,$rootScope,$localStorage) {
    $scope.students;

    getStudent_list();




    function getStudent_list() {

        liststudent_students.getListstudent_students($localStorage.course_id_student)
            .success(function (data) {
                $scope.students = data;
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }




});

