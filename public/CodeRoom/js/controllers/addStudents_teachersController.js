
app.controller('addstudents_teachersController',function($scope, $http, Upload, $timeout,$stateParams,$rootScope,$localStorage,$state,liststudent_teachers,allStudent) {



    getStudent_list();
    $scope.students = {};
    var studentCourse;
    var allStudent;
    function getStudent_list() {

        liststudent_teachers.getListstudent_teacher($localStorage.course_id_teacher)
            .success(function (data) {
                studentCourse = addPathImage(data);
                getAllstudent();
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }
    function getAllstudent() {

        allStudent.getAllStudent()
            .success(function (data) {
                allStudent = addPathImage(data);
                deleteRedundant();
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

    function deleteRedundant(){
        for(i=0 ; i<studentCourse.length ; i++){
            for(j=0 ; j<allStudent.length ; j++){
                if(studentCourse[i].id === allStudent[j].id){
                    allStudent.splice(j,1);
                }
            }
        }
        $scope.students = {
            allStudent: allStudent,
            studentCourse: studentCourse
        }
    }


    $scope.$watch('students', function(model) {
        $scope.modelAsJson = angular.toJson(model, true);
    }, true);


    $scope.addStudents = function(){
        $scope.students.course_id = $localStorage.course_id_teacher;
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
