angular.module('starter.services')
    .factory('usuario', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/autenticarUsuario', {}, {
            query: {
                isArray: false
            },
            autenticarUsuario: {
                method: 'GET',
                url: appConfig.baseUrl + '/api/autenticarUsuario'
            }
        });
    }]);