
app.controller('homeController',function($scope,$http,$localStorage,$location) {

    $scope.go = function ( path ) {
        $location.path( path );
    };

});
