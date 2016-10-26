/**
 * Created by thanadej on 10/26/2016 AD.
 */

app.controller('addLesson_teachersController',function($scope,$stateParams,$rootScope,$localStorage) {

    $scope.course_id = $stateParams.course_id;

    $scope.lesson = {
        name: $scope.name,
        course_id: $scope.course_id,
        status: "true",
        order: $scope.order,
    };
    $scope.addLesson = function(){
        var res = $http.post('/lesson', $scope.lesson);
        res.success(function(data, status, headers, config) {
            $scope.message2 = data;
            location.reload();

        });
        res.error(function(data, status, headers, config) {
            alert( "failure message: " + JSON.stringify({data: data}));
        });
    };



});