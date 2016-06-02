angular.module('starter.services')
    .service('$loadingCustomizado', ['$ionicLoading', function ($ionicLoading) {
        this.carregar = function () {
            $ionicLoading.show({
                template: '<ion-spinner icon="android"></ion-spinner>'
            });
        }

        this.esconder = function () {
            $ionicLoading.hide();
        }
    }]);