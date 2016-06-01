angular.module('starter.controllers')
    .controller('MovimentoCtrl', [
        '$scope', function ($scope) {

            $scope.products = [{
                name: 'FURB',
                price: 122,
                favorito: false
            }, {
                name: 'Academia',
                price: 262,
                favorito: true
            }, {
                name: 'Cooper',
                price: 12,
                favorito: false
            }, {
                name: 'Inventti teste te de mais teste para mais ',
                price: 1600,
                favorito: true
            }, {
                name: 'Inventti teste te de mais teste para mais ',
                price: 1600,
                favorito: true
            }, {
                name: 'Inventti teste te de mais teste para mais ',
                price: 1600,
                favorito: true
            }, {
                name: 'Inventti teste te de mais teste para mais ',
                price: 1600,
                favorito: true
            }, {
                name: 'Inventti teste te de mais teste para mais ',
                price: 1600,
                favorito: true
            }, {
                name: 'Inventti teste te de mais teste para mais ',
                price: 1600,
                favorito: true
            }, {
                name: 'Cooper',
                price: 12,
                favorito: false
            },];


            $scope.favoritos = function (x) {
                x.favorito = !x.favorito;
            }
        }]);