
app.controller('viewMemberController',function($scope,viewMember,$localStorage,$http,$routeParams,$location,$uibModal) {
    $scope.viewMember;
    $scope.cardUser = false;
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;
    getData($localStorage.user.token,$localStorage.course_id);

    function getData(token,course_id) {

        viewMember.getData(token,course_id).then(
            function(response){
                var data = response.data;
                if(data.status === "session expired"){
                    $scope.timeOut();
                }else if(data.status === undefined){
                    $scope.viewMember = addPathimage(data);
                    console.log($scope.viewMember);
                }

            },
            function(response){
                // failure call back
            });

    }
    function addPathimage(data){
        for(var i in data){
            if(i=="students"){
                for(j=0 ; j<data[i].length;j++){
                    data[i][j].image = "http://localhost:8000/api/image/"+data[i][j].image;
                }
            }else if(i=="teachers"){
                for(j=0 ; j<data[i].length;j++){
                    data[i][j].image = "http://localhost:8000/api/image/"+data[i][j].image;
                }
            }
        }
        return data;
    }



    $scope.openCarduser  = function(){
        if($scope.cardUser){
            document.getElementById("showCarduser").style.display = "none";


        }else {
            document.getElementById("showCarduser").style.display = "block";

        }
        $scope.cardUser = !$scope.cardUser;
    };
    $scope.go = function ( path ) {
        $location.path( path );
    };

    $scope.logout = function () {

        $http.get('/logout', {headers:{
                'Authorization_Token' : $localStorage.user.token
            }})
            .then(
                function(response){
                    delete $localStorage.user;
                    $location.path('/home');
                },
                function(response){
                    // failure callback
                }
            );
    }
    $scope.timeOut = function (size, parentSelector) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
        var modalInstance = $uibModal.open({
            animation: $scope.animationsEnabled,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            backdrop:'static',
            templateUrl: '../Coderoom2/js/views/model/tokenExpired.html',
            controller: function($scope,$uibModalInstance){

                $scope.Login = function () {
                    $uibModalInstance.close("login");
                };

            },
            size: size,
            appendTo: parentElem,

        })
        modalInstance.result.then(function (login) {
            if(login==="login"){
                $scope.logout();
            }
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });

    }
});

