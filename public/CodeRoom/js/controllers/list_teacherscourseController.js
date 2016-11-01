
app.controller('list_teachercourseController',function($scope,list_teachersCourse,$stateParams,$rootScope,$localStorage) {
    $scope.teachers;
    getTeachersCourse();




    function getTeachersCourse() {

        list_teachers.getList_teacherCourse($localStorage.course_id_teacher)
            .success(function (data) {
                $scope.teachers= data;
                console.log($scope.teachers);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }




});