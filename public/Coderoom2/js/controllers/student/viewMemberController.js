
app.controller('viewMemberController',function($scope,viewMember,$localStorage,$http,$routeParams,$location) {
    $scope.viewMember;
    $scope.cardUser = false;
    $scope.user = $localStorage.user;
    $localStorage.course_id = $routeParams.course_id;
    getData($localStorage.user.token,$localStorage.course_id);
    function getData(token,course_id) {

        viewMember.getData(token,course_id).then(
            function(response){
                $scope.viewMember = addPathimage(response.data);
                console.log($scope.viewMember);

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
});

