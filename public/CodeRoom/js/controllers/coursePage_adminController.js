
app.controller('coursePage_adminController',function($scope,$stateParams,$rootScope,$localStorage,coursePage_admin,delete_teacher_admin) {
    $scope.detail_course;
    $localStorage.course_id_admin = $stateParams.course_id;


    getDetail_course();
    function getDetail_course() {

        coursePage_admin.getCoursePage_admin($localStorage.admin_id,$localStorage.course_id_admin)
            .success(function (data) {
                $scope.detail_course = addPath(data);
                console.log($scope.detail_course);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }
    function addPath(data){
        for(i=0 ; i<data.teachers.length ; i++){
            data.teachers[i].image = "http://localhost:8000/api/image/"+ data.teachers[i].image;
        }
        return data;
    }

    $scope.deleteTeacher = function(teacher_id){
        delete_teacher_admin.getDelete_teacher_admin(teacher_id,$localStorage.course_id_admin)
            .success(function (data) {
               getDetail_course();
                location.reload();
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    };


});
