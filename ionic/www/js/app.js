angular.module('starter.controllers', []);
angular.module('starter.services', []);

angular.module('starter', [
    'ionic',
    'starter.controllers',
    'starter.services',
    'angular-oauth2',
    'ngResource',
    'ngCordova',
    'jett.ionic.filter.bar'
])
    .run(function ($ionicPlatform) {
        $ionicPlatform.ready(function () {
            if (window.cordova && window.cordova.plugins.Keyboard) {
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
                cordova.plugins.Keyboard.disableScroll(true);
            }
            if (window.StatusBar) {
                StatusBar.styleDefault();
            }
        });
    })

    .constant('appConfig', {
        baseUrl: 'http://localhost:8000',
        //baseUrl: 'http://caderneta.peixer.com/',
        direcionarAposLogin: {
            usuario: 'usuario.movimentos'
        }
    })

    .config(function ($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider, appConfig, $ionicFilterBarConfigProvider) {
        $stateProvider
            .state('login', {
                url: '/login',
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            })
            .state('usuario', {
                abstract: true,
                cache: false,
                url: '/usuario',
                templateUrl: 'templates/menu.html',
                controller: 'UsuarioMenuCtrl'
            })
            .state('usuario.movimentos', {
                url: '/movimentos',
                templateUrl: 'templates/movimentos/movimentos.html',
                controller: 'MovimentoCtrl'
            })
            .state('usuario.inclusaoMovimento', {
                url: '/movimentos/inclusao',
                templateUrl: 'templates/movimentos/incluir.html',
                controller: 'IncluirMovimentoCtrl'
            })
            .state('usuario.historico', {
                url: '/historico',
                templateUrl: 'templates/historico/historico.html'
            });

        $urlRouterProvider.otherwise('/login');

        // Configurações p/ OAUTH
        OAuthProvider.configure({
            baseUrl: appConfig.baseUrl,
            clientId: 'appid01',
            clientSecret: 'secret', // optional
            grantPath: '/oauth/access_token'
        });

        // Configurações do Cookies
        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false //Criptografar com HTTPS
            }
        });

        $ionicFilterBarConfigProvider.theme('balanced');
        $ionicFilterBarConfigProvider.clear('ion-close');
        $ionicFilterBarConfigProvider.backdrop(true);
        $ionicFilterBarConfigProvider.transition('horizontal');
        $ionicFilterBarConfigProvider.placeholder('Pesquisar');
    });
