
app.controller('addstudents_teachersController',function($scope, $http, Upload, $timeout,$stateParams,$rootScope,$localStorage,$state) {


    $scope.isAddStudent = true;
    $scope.isAddStudents = false;
    $scope.setActive = function(menuItem) {
        if(menuItem === 0){
            $scope.isAddStudent  = true;
            $scope.isAddStudents = false;
        }else{
            $scope.isAddStudent  = false;
            $scope.isAddStudents = true;
        }
    };

    //upload
    $scope.uploadFiles = function(file) {


        file.upload = Upload.upload({
            url: '/api/student/add_many_student_member',
            data: {studentList: file, course_id: $localStorage.course_id_teacher},
        });

        file.upload.then(function (response) {
            $timeout(function () {

                file.result = response.data;
                
                $state.go("liststudent_teachers");

                //console.log($scope.teacherRequirement);

            });
        }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };

    $scope.student = {
        course_id: $localStorage.course_id_teacher
    };

    $scope.addStudent = function(){
        console.log($scope.student);
        var res = $http.post('/api/student/add_one_student_member', $scope.student);

        res.success(function(data, status, headers, config) {
            $scope.message2 = data;

            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };








});
