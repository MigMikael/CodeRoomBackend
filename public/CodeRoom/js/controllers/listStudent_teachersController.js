
app.controller('liststudent_teachersController',function($scope,liststudent_teachers,delete_student_teachers,$stateParams,$rootScope,$localStorage) {
    $scope.students;

    getStudent_list();

    $scope.deleteStudent = function(student_id){
        delete_student_teachers.getDelete_student_teachers(student_id,$stateParams.course_id_teacher)
            .success(function (data) {
               getStudent_list();
                location.reload();
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    };


    function getStudent_list() {

        liststudent_teachers.getListstudent_teacher($localStorage.course_id_teacher)
            .success(function (data) {
                $scope.students = addPathImage(data);


            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }

    function addPathImage(data) {
        for(i=0 ; i<data.length ;i++){
            data[i].image = "http://localhost:8000/api/image/"+data[i].image;
        }
        return data;
    }




});
