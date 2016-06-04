angular.module('starter.controllers')
    .controller('MovimentoCtrl', [
        '$scope', 'movimento', '$loadingCustomizado', '$ionicPopup', '$ionicFilterBar', '$cordovaToast',
        function ($scope, movimento, $loadingCustomizado, $ionicPopup, $ionicFilterBar, $cordovaToast) {
            $scope.produtos = [];
            var filterBarInstance;

            carregarMovimentos();

            function carregarMovimentos() {
                $loadingCustomizado.carregar();

                obterMovimentosPromise().then(function (data) {
                    $scope.produtos = data.data;
                    $loadingCustomizado.esconder();
                }, function (dataErro) {
                    $loadingCustomizado.esconder();
                });
            };

            function obterMovimentosPromise() {
                return movimento.obterMovimentos().$promise;
            }

            $scope.favoritos = function (produto) {
                produto.favorito = !produto.favorito;


                var promiseAlterarStatusFavorito = movimento.alterarStatusFavorito({id: produto.id}).$promise;
                promiseAlterarStatusFavorito.then(function (data) {
                    var mensagem;
                    if (produto.favorito)
                        mensagem = 'Produto incluído em favoritos';
                    else
                        mensagem = 'Produto removido de favoritos';

                    $cordovaToast.show(mensagem, 'short', 'bottom');
                }, function (dataErro) {
                    $cordovaToast.show('Erro ao alterar produto', 'short', 'bottom');
                });
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

            $scope.atualizarMovimentos = function () {

                if (filterBarInstance) {
                    filterBarInstance();
                    filterBarInstance = null;
                }

                obterMovimentosPromise().then(function (data) {
                    $scope.produtos = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function (data) {
                    $scope.$broadcast('scroll.refreshComplete');
                });
            };

            $scope.abrirPesquisa = function () {
                filterBarInstance = $ionicFilterBar.show({
                    items: $scope.produtos,
                    favoritesEnabled: true,
                    update: function (filteredItems, filterText) {
                        $scope.produtos = filteredItems;
                    }
                });
            }
        }]);