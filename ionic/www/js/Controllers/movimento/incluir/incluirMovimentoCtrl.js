angular.module('starter.controllers')
    .controller('IncluirMovimentoCtrl', ['$scope', '$ionicHistory', '$loadingCustomizado', '$ionicPopup', 'movimento', 'armazenadorProduto',
        function ($scope, $ionicHistory, $loadingCustomizado, $ionicPopup, movimento, armazenadorProduto) {

            $scope.movimento = {};

            function inicializar() {
                $scope.movimento = JSON.parse(armazenadorProduto.obter());
                
                $scope.movimento.data = new Date($scope.movimento.data);
            }

            inicializar();

            $scope.salvar = function () {
                $loadingCustomizado.carregar();

                var promiseinserirOuAtualizarMovimento = movimento.inserirOuAtualizarMovimento($scope.movimento).$promise;

                promiseinserirOuAtualizarMovimento.then(function (data) {
                    $loadingCustomizado.esconder();
                    var backView = $ionicHistory.backView();
                    backView.go();

                }, function (dataErro) {
                    $loadingCustomizado.esconder();
                    $ionicPopup.alert({
                        title: 'Erro',
                        template: montarMensagemDeErro()
                    });
                });
            };

            function montarMensagemDeErro() {
                if ($scope.movimento.id == 0)
                    return 'Erro ao inserir movimento';
                return 'Erro ao atualizar movimento';
            }
        }
    ]);