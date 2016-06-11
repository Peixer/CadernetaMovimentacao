angular.module('starter.controllers')
    .controller('InclusaoMovimentoCtrl', ['$scope', '$ionicHistory', '$loadingCustomizado', '$ionicPopup', 'movimento',
        function ($scope, $ionicHistory, $loadingCustomizado, $ionicPopup, movimento) {

            $scope.movimento = {
                descricao: '',
                data: '',
                tipoCobranca: '',
                total: '',
                favorito: false,
            };

            $scope.salvar = function () {
                console.log($scope.movimento);
                $loadingCustomizado.carregar();

                for (var i = 0; i < 10; i++) {
                    var promiseAdicionarMovimento = movimento.adicionarMovimento($scope.movimento).$promise;

                    promiseAdicionarMovimento.then(function (data) {
                        $loadingCustomizado.esconder();
                        var backView = $ionicHistory.backView();
                        backView.go();

                    }, function (dataErro) {
                        $loadingCustomizado.esconder();
                        $ionicPopup.alert({
                            title: 'Erro',
                            template: 'Erro ao incluir'
                        });
                    });
                }
            };
        }
    ]);