app.controller('dashboard_studentsController', function($scope, $http,$rootScope, studentCourse,allCourse_students,$stateParams,$localStorage) {
    $scope.my_courses;
    $scope.all_courses;
    $scope.have_courses = [];

    getStudentCourse();
    getAllCourse();
    setUser();

    function setUser(){
        $localStorage.student_id = 3;
    }

    function getStudentCourse() {

        studentCourse.getStudentCourse($localStorage.student_id)
            .success(function (data) {

                $scope.my_courses = data;
                for(var i in $scope.my_courses){
                    $scope.have_courses.push($scope.my_courses[i].course_id);
                }


            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }

    function getAllCourse() {
        //$stateParams.student_code
        allCourse_students.getallCourse_students()
            .success(function (data) {
                console.log(data);
                $scope.all_courses = deleteDataredundancy(data);


            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }

    var deleteDataredundancy = function(course){
        var demo_course = course;
        for(var i in $scope.have_courses){
            for(var y in demo_course){
                if($scope.have_courses[i]==demo_course[y].id){

                    demo_course.splice(y, 1);
                }
            }
        }
        return demo_course;
    }


});



