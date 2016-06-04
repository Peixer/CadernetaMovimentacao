angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope', 'OAuth', 'OAuthToken', '$ionicPopup', 'informacoesUsuario', '$direcionador', 'usuario', '$loadingCustomizado',
        function ($scope, OAuth, OAuthToken, $ionicPopup, informacoesUsuario, $direcionador, usuario, $loadingCustomizado) {

            $scope.usuario = {
                username: '',
                password: ''
            };

            $scope.$on('$ionicView.enter', function () {
                obterInformacoesUsuarioArmazenadas();
            });

            function obterInformacoesUsuarioArmazenadas() {
                var infUsuario = informacoesUsuario.obter();

                if (infUsuario)
                    $direcionador.direcionarAposLogin();
            };

            $scope.login = function () {

                $loadingCustomizado.carregar();

                var promiseAccessToken = OAuth.getAccessToken($scope.usuario);

                promiseAccessToken.then(function (data) {
                    return usuario.autenticarUsuario().$promise;
                }).then(function (data) {
                    informacoesUsuario.atribuir(data.data);
                    $loadingCustomizado.esconder();
                    $direcionador.direcionarAposLogin();
                }, function (dataErro) {
                    informacoesUsuario.atribuir(null);
                    OAuthToken.removeToken();
                    $loadingCustomizado.esconder();
                    $ionicPopup.alert({
                        title: 'Erro',
                        template: 'Login e/ou senha inválidos'
                    });
                });
            }
        }]);