
app.controller('dashboard_adminController',function($scope,$http,$rootScope,$stateParams,$localStorage,adminCourse) {

    $scope.myAdmin_courses;
    setUser();
    getAdminCourse();

    function setUser(){
        $localStorage.admin_id = '1';
    }


    function getAdminCourse(){
        adminCourse.getAdminCourse()
            .success(function (data) {
                $scope.myAdmin_courses = data;
                console.log($scope.myAdmin_courses);

            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });
    }

});
