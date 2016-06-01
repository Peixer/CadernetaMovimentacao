angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope', 'OAuth', 'OAuthToken', '$ionicPopup', 'UserData', '$redirect',
        function ($scope, OAuth, OAuthToken, $ionicPopup, UserData, $redirect) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                var promiseAccessToken = OAuth.getAccessToken($scope.user);

                promiseAccessToken.then(function (data) {
                    UserData.set(data.data);
                    $redirect.redirectAfterLogin();
                }, function (dataErro) {
                    UserData.set(null);
                    OAuthToken.removeToken();
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login e/ou senha inválidos'
                    });
                });
            }
        }]);