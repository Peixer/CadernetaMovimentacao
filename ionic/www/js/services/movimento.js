angular.module('starter.services')
    .factory('movimento', ['$resource', 'appConfig', function ($resource, appConfig) {
        var url = appConfig.baseUrl + '/api/';
        return $resource(url, {}, {
            obterMovimentos: {
                method: 'GET',
                url: url + 'movimentos'
            },
            obterMovimentosFavoritos: {
                method: 'GET',
                url: url + 'movimentosFavoritos',
            },
            deletarMovimento: {
                method: 'GET',
                url: url + 'deletarMovimento/:id',
                paramDefaults: {id: '@id'}
            }
        });
    }]);