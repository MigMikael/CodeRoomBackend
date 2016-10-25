
app.controller('dashboard_teachersController',function($scope,$http,$rootScope,$stateParams,$localStorage,teacherCourse) {

    $scope.myTeacher_courses;
    setUser();
    getMycourse_teacher();

    function setUser(){
        $localStorage.teacher_id = '1';
    }


    function getMycourse_teacher(){
        teacherCourse.getteacherCourse($localStorage.teacher_id)
            .success(function (data) {
                $scope.myTeacher_courses = data;

            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });
    }

});
