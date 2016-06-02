angular.module('starter.services')
    .factory('movimento', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/movimentos', {}, {
            obterMovimentos: {
                method: 'GET',
                url: appConfig.baseUrl + '/api/movimentos'
            }
        });
    }]);