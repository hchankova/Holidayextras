(function () {
    var user = {};
    var app = angular.module('controller', []);
    app.controller('userController', function ($scope, $state, userSrv) {
        function getAll() {
            $scope.users = userSrv.query();
        };
        getAll();
        $scope.add = function () {
            user = {};
            $state.go('form');
        };
        $scope.edit = function (data) {
            user = data;
            $state.go('form');
        };
        $scope.remove = function (id){
            var r = confirm("Are you sure you want to delete this user? ");
            if (r === true) {
                userSrv.delete({id: id}, function () {
                    getAll();
                    alert('The user was successfully deleted.');
                });
            } else {
                getAll();
            }
        };
    });
    app.controller('formController', function ($scope, $state, userSrv) {
        $scope.post = user;
        $scope.back = function () {
            $state.go('user');
        };
        $scope.save = function () {
            //alert($scope.post.id);
            if ($scope.post.id === undefined) {
                userSrv.save($scope.post, function () {
                    $scope.post = '';
                    alert('The user was successfully saved.');
                    $state.go('user');
                });
            } else {
                userSrv.update($scope.post, function () {
                    alert('The user was successfully updated.');
                    $state.go('user');
                });
            }
        };
    });
})();