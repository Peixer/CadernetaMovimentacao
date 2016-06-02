angular.module('starter.services')
    .factory('informacoesUsuario', ['armazenador', function (armazenador) {
        var key = 'usuario';
        return {
            obter: function () {
                return armazenador.obterObjeto(key);
            },
            atribuir: function (value) {
                return armazenador.atribuirObjeto(key, value);
            }
        }
    }]);