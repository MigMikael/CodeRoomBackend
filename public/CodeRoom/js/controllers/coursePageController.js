/**
 * Created by thanadej on 7/1/2016 AD.
 */
app.controller('coursePageController',function($scope,mycourse,$stateParams,$rootScope) {
    $scope.course;
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
//jdsflkajlfkjaldskfals

    
    function getCourse() {
        mycourse.getMycourse($rootScope.student_id,$stateParams.course_id)
            .success(function (data) {
                $scope.course = data;
                console.log($scope.course);
            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }




});