angular.module('starter.services')
    .service('$direcionador', ['$state', 'appConfig', function ($state, appConfig) {
        this.direcionarAposLogin = function () {
            $state.go(appConfig.direcionarAposLogin.usuario);
        };
    }]);