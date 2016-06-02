angular.module('starter.controllers')
    .controller('MovimentoCtrl', [
        '$scope', 'movimento', '$loadingCustomizado', function ($scope, movimento, $loadingCustomizado) {
            $scope.produtos = [];

            carregarMovimentos();

            function carregarMovimentos() {
                $loadingCustomizado.carregar();
                var promiseMovimento = movimento.obterMovimentos().$promise

                promiseMovimento.then(function (data) {
                    $scope.produtos = data.data;
                    $loadingCustomizado.esconder();
                }, function (dataErro) {
                    $loadingCustomizado.esconder();
                });
            };


            $scope.favoritos = function (x) {
                x.favorito = !x.favorito;
            }
        }]);