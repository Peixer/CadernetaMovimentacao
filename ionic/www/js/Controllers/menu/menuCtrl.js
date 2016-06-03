angular.module('starter.controllers')
    .controller('UsuarioMenuCtrl',
        ['$scope', 'informacoesUsuario', '$state',
            function ($scope, informacoesUsuario, $state) {

                $scope.usuario = informacoesUsuario.obter();

                $scope.logout = function () {
                    $state.go('logout');
                };
            }]);