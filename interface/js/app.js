(function () {
    var app = angular.module('app', [
        'ngResource',
        'ui.router',
        'service',
        'controller'
    ]);
    app.config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/user');
        $stateProvider.state('user', {
            url: '/user',
            templateUrl: 'views/user.html',
            controller: 'userController'
        }).state('form', {
            url: '/form',
            templateUrl: 'views/form.html',
            controller: 'formController'
        });
    });
})();

