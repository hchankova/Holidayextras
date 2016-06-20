(function () {
    var app = angular.module('service', []);
    app.factory('userSrv',function ($resource){
         return $resource('../api/user/:id', {id: '@id'}, {
            'update': {method: 'PUT'}
        });
    });
})();
