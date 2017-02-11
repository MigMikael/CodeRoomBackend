
app.controller('editProblemteacherController',function($scope,$localStorage,$routeParams,$http,$location,problemTeacher,Upload) {
    $scope.user = $localStorage.user;
    $localStorage.prob_id = $routeParams.prob_id;
    $scope.problemView = true;
    $scope.parseProblemView = false;


    $scope.evaluator = {
        values:[
            {
                value:'java',
                name:'Java'
            },
            {
                value:'c',
                name:'C'
            },

        ],
        selectValue:{value:'java',name:'Java'}
    };
    $scope.is_parse = {
        values:[
            {
                value:true,
                name:'Parse'
            },
            {
                value:false,
                name:'Not Parse'
            },

        ],
        selectValue:{value:true,name:'Parse'}
    };


    //getData($localStorage.user.token,$localStorage.lesson_id );

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
    $scope.changeView = function(view){
        if(view === "problemView"){
            $scope.problemView = true;
            $scope.parseProblemView = false;
            $scope.notParseProblemView = false;
        }else if(view === "parseProblemView"){
            $scope.problemView = false;
            $scope.parseProblemView = true;
            $scope.notParseProblemView = false;
        }
    };

    function getData(token,prob_id) {

        problemTeacher.getData(token,prob_id).then(
            function(response){
                $scope.lesson = response.data;
                console.log($scope.lesson);

            },
            function(response){
                // failure call back
            });

    }


    $scope.logout = function () {

        $http.get('/logout', {headders:{
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
    //upload
    $scope.uploadFiles = function(file) {
        file.upload = Upload.upload({
            url: '/api/teacher/problem/store',
            data: {file: file,
                lesson_id:$localStorage.lessons_id,
                name:$scope.name,
                description:$scope.description,
                evaluator:$scope.evaluator.selectValue.values,
                timelimit:$scope.timelimit,
                memorylimit:$scope.memorylimit,
                is_parse:$scope.is_parse.selectValue.values
            },
            headers:{'Authorization_Token' : $localStorage.user.token},
        });

        file.upload.then(function (response) {
            $timeout(function () {
                console.log(response.data);
                //parse and not parse go
                if(true){

                }else{

                }
            })
        }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    };

});







