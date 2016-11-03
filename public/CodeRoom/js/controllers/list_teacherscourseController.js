
app.controller('list_teachercourseController',function($scope,list_teachersCourse,$stateParams,$rootScope,$localStorage) {
    $scope.teachers;
    console.log($stateParams.course_id);
    $localStorage.course_id = $stateParams.course_id;
    getTeachersCourse();




    function getTeachersCourse() {

        list_teachersCourse.getList_teacherCourse($localStorage.course_id)
            .success(function (data) {
                $scope.teachers = addPath(data);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }
    function addPath(data){
        for(i=0;i<data.length ;i++){
            data[i].image = "http://localhost:8000/api/image/"+data[i].image

        }
        return data;
    }





});