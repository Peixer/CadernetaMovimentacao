angular.module('starter.controllers')
    .controller('MovimentoCtrl', [
        '$scope', 'movimento', '$loadingCustomizado', '$ionicPopup', function ($scope, movimento, $loadingCustomizado, $ionicPopup) {
            $scope.produtos = [];

            carregarMovimentos();

            function carregarMovimentos() {
                $loadingCustomizado.carregar();
                var promiseMovimento = movimento.obterMovimentos().$promise;

                promiseMovimento.then(function (data) {
                    $scope.produtos = data.data;
                    $loadingCustomizado.esconder();
                }, function (dataErro) {
                    $loadingCustomizado.esconder();
                });
            };

            $scope.favoritos = function (produto) {
                produto.favorito = !produto.favorito;
            };

            $scope.deletar = function (produto, index) {

                $loadingCustomizado.carregar();

                var promiseDeletarMovimento = movimento.deletarMovimento({id: produto.id}).$promise;
                promiseDeletarMovimento.then(function (data) {

                    $scope.produtos.splice(index, 1);

                    $loadingCustomizado.esconder();

                    $ionicPopup.alert({
                        title: 'Sucesso',
                        template: 'Item deletado'
                    });
                }, function (dataErro) {
                    $loadingCustomizado.esconder();

                    $ionicPopup.alert({
                        title: 'Alerta',
                        template: 'Não foi deletado item'
                    });
                });
            };
        }]);