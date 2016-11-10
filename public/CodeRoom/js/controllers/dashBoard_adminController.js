
app.controller('dashboard_adminController',function(allTeachers_admin,$scope,$http,$rootScope,$stateParams,$localStorage,adminCourse) {

    $scope.myAdmin_courses;
    setUser();
    getAdminCourse();
    getAllTeacher();
    function setUser(){
        $localStorage.admin_id = '1';
    }


    function getAdminCourse(){
        adminCourse.getAdminCourse()
            .success(function (data) {
                $scope.myAdmin_courses = data;


            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });
    }
    function getAllTeacher(){
        allTeachers_admin.getAllTeachers_admin()
            .success(function (data) {
                $scope.teachers = addPath(data);
                console.log($scope.teachers);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });
    }

    function addPath(data){
        for(i=0 ; i<data.length ; i++){
            data[i].image = "http://localhost:8000/api/image/"+ data[i].image;
        }
        return data;
    }
    $scope.deleteTeacher = function (teacher_id) {

        $http.delete('/teacher/' + teacher_id)
            .success(function (data, status, headers) {
                location.reload();
                getAdminCourse();
                getAllTeacher();
            })
            .error(function (data, status, header, config) {

            });
    };

});
