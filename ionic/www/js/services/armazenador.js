angular.module('starter.services')
    .factory('armazenador', ['$window', function ($window) {
        return {
            obter: function (chave, valorPadrao) {
                return $window.localStorage[chave] || valorPadrao;
            },
            atribuir: function (chave, valor) {
                $window.localStorage[chave] = valor;
                return valor;
            },
            atribuirObjeto: function (chave, valor) {
                $window.localStorage[chave] = JSON.stringify(valor);
                return this.obterObjeto(chave);
            },
            obterObjeto: function (chave) {
                return JSON.parse($window.localStorage[chave] || null);
            }
        }
    }]);