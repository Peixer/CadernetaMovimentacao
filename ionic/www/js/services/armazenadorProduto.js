angular.module('starter.services')
    .factory('armazenadorProduto', ['$window', function ($window) {
        var chave = 'produto';

        var movimentoInicial = {
            descricao: '',
            data: '',
            tipoCobranca: '',
            total: '',
            favorito: false,
            id: 0,
        };

        return {
            obter: function () {
                return $window.localStorage[chave] || movimentoInicial;
            },
            atribuir: function (valor) {
                $window.localStorage[chave] = valor;
                return valor;
            },
            limparArmazenador: function () {
                $window.localStorage[chave] = JSON.stringify(movimentoInicial);
                return movimentoInicial;
            }
        }
    }]);