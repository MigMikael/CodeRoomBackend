/**
 * Created by thanadej on 7/1/2016 AD.
 */
app.controller('coursePageController', ['$scope',function($scope) {
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
    }


}]);