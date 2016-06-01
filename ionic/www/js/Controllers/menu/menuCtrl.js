angular.module('starter.controllers')
    .controller('UsuarioMenuCtrl',
        ['$scope', '$ionicLoading', 'UserData', '$state',
            function ($scope, $ionicLoading, UserData, $state) {

                $scope.user = UserData.get();

                $scope.logout = function () {
                    $state.go('logout');
                };
            }]);