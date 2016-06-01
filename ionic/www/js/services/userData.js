angular.module('starter.services')
    .factory('UserData', ['$localStorage', function ($localStorage) {
        var key = 'user';
        return {
            get: function () {
                return $localStorage.getObject(key);
            },
            set: function (value) {
                return $localStorage.setObject(key, value);
            }
        }
    }]);