app.controller('studentController', function($scope, $http,$rootScope, studentcourse,allcourse,$stateParams) {
    $scope.my_courses;
    $scope.all_courses;
    $scope.have_courses = [];
    $rootScope.student_id = '07560550';
    getStudentCourse();
    getAllCourse();

    function getStudentCourse() {
        //$stateParams.student_code
        studentcourse.getStudentCourse($rootScope.student_id)
            .success(function (data) {
                $scope.my_courses = data;
                for(var i in $scope.my_courses){
                    $scope.have_courses.push($scope.my_courses[i].id);
                }


            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }
    //ตรงนี้ต้องแก้เพราะว่า เราต้องเอาครอสที่เขามีออกด้วย
    function getAllCourse() {
        //$stateParams.student_code
        allcourse.getAllCourse()
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



