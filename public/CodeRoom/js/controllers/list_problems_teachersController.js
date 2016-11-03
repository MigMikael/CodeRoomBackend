
app.controller('list_problems_teachercourseController',function($scope,list_problems_teacher,$stateParams,$rootScope,$localStorage) {
    $scope.listProblems;

    getList_problem();



    function getList_problem() {

        list_problems_teacher.getList_problems_teacher($localStorage.lesson_id_teacher)
            .success(function (data) {
                $scope.listProblems= data;
                console.log($scope.listProblems);

            })
            .error(function (error) {
                $scope.status = 'Unable to load customer data: ' + error.message;
            });

    }





});
