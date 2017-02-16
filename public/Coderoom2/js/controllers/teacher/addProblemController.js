
app.controller('addProblemteacherController',function($scope,Upload,$localStorage,$routeParams,$http,$location) {

    $scope.user = $localStorage.user;
    $localStorage.lesson_id = $routeParams.lessons_id;
    $scope.problemView = true;
    $scope.parseProblemView = false;

    $scope.evaluator = {
        values:[
            {
                value:'java',
                name:'Java'
            },

        ],
        selectValue:{value:'java',name:'Java'}
    };
    $scope.is_parse = {
        values:[
            {
                value: true,
                name:'Parse'
            },
            {
                value: false,
                name:'Not Parse'
            },

        ],
        selectValue:{value: true ,name:'Parse'}
    };

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

        }else if(view === "parseProblemView"){
            $scope.problemView = false;
            $scope.parseProblemView = true;

        }
    };
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
                evaluator:$scope.evaluator.selectValue.value,
                timelimit:$scope.timelimit,
                memorylimit:$scope.memorylimit,
                is_parse:$scope.is_parse.selectValue.value
            },
            headers:{'Authorization_Token' : $localStorage.user.token},
        });

        file.upload.then(function (response) {
            $timeout(function () {
                console.log($scope.is_parse.selectValue.value);
                if($scope.is_parse.selectValue.value){
                    $scope.resultAnalyze = response.data;
                    console.log($scope.resultAnalyze);
                    $scope.changeView("parseProblemView");
                }else{
                    $location.go('/listproblemteacher/'+$localStorage.lessons_id)
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




