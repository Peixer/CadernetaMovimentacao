angular.module('starter.controllers')
    .service('$redirect', ['$state', 'appConfig', function ($state, appConfig) {
        this.redirectAfterLogin = function () {
            $state.go(appConfig.redirectAfterLogin.usuario);
        };
    }]);