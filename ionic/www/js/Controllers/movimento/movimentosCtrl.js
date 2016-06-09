angular.module('starter.controllers')
    .controller('MovimentoCtrl', [
        '$scope', 'movimento', '$loadingCustomizado', '$ionicPopup', '$ionicFilterBar', '$cordovaToast',
        function ($scope, movimento, $loadingCustomizado, $ionicPopup, $ionicFilterBar, $cordovaToast) {
            $scope.produtos = [];
            $scope.temMaisItens = true;
            var pagina = 1;
            var filterBarInstance;

            function carregarMovimentos() {
                $loadingCustomizado.carregar();

                obterMovimentosPromise(1).then(function (data) {
                    $scope.produtos = data.data;
                    $loadingCustomizado.esconder();
                }, function (dataErro) {
                    $loadingCustomizado.esconder();
                });
            };

            function obterMovimentosPromise(paginaMovimentos) {
                return movimento.obterMovimentos({
                    page: paginaMovimentos,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
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
                    $cordovaToast.show('Produto deletado', 'short', 'bottom');
                }, function (dataErro) {
                    $loadingCustomizado.esconder();

                    $ionicPopup.alert({
                        title: 'Alerta',
                        template: 'Produto não foi deletado'
                    });
                });
            };

            $scope.atualizarMovimentos = function () {

                if (filterBarInstance) {
                    filterBarInstance();
                    filterBarInstance = null;
                }

                obterMovimentosPromise(1).then(function (data) {
                    $scope.produtos = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function (data) {
                    $scope.$broadcast('scroll.refreshComplete');
                });
            };

            $scope.abrirPesquisa = function () {
                filterBarInstance = $ionicFilterBar.show({
                    items: $scope.produtos,
                    filterProperties : ['descricao'],
                    update: function (filteredItems, filterText) {
                        $scope.produtos = filteredItems;
                    }
                });
            };

            $scope.carregarMaisMovimentos = function () {
                obterMovimentosPromise(pagina).then(function (data) {
                    $scope.produtos = $scope.produtos.concat(data.data);
                    if ($scope.produtos.length == data.meta.pagination.total) {
                        $scope.temMaisItens = false;
                    }

                    pagina += 1;

                    $scope.$broadcast('scroll.infiniteScrollComplete');
                });
            }
        }]);