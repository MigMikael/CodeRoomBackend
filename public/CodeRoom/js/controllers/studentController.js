app.controller('studentController', ['$scope','$http','studentcourse','allcourse',function($scope, $http, studentcourse,allcourse) {

    studentcourse.success(function(data) {
        $scope.current_Course = data;
        console.log($scope.current_Course);
    });
    allcourse.success(function(data){
       $scope.all_course = data;
        console.log($scope.all_course);
    });


}]);

/**
 * Created by thanadej on 7/1/2016 AD.
 */
