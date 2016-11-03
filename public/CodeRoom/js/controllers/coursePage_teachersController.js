
app.controller('coursePage_teachersController',function($scope,coursePage_teachers,$stateParams,$rootScope,$localStorage) {
    $scope.course_teachers;
    $localStorage.course_id_teacher = $stateParams.course_id;

    getCourse();
    $scope.isProfilecourse = true;
    $scope.isProfileyouself = false;
    $scope.setActive = function(menuItem) {
        if(menuItem === 0){
            $scope.isProfilecourse = true;
            $scope.isProfileyouself = false;
        }else{
            $scope.isProfilecourse = false;
            $scope.isProfileyouself = true;
        }
    };






    function getCourse() {

        coursePage_teachers.getCoursePage_teachers($localStorage.teacher_id,$localStorage.course_id_teacher)
            .success(function (data) {
                $scope.course_teachers = data;
                console.log($scope.course_teachers);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }




});