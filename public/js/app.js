/**
 * Created by Glaicon on 28/04/2016.
 */
angular.module('app', ['ngResource'])
    .constant('appConfig', {
        baseUrl: 'http://localhost:8000'
        // baseUrl: 'http://caderneta.peixer.com'
    })
    .controller("appCtrl", function () {
        $(document).ready(function () {
            $('.left.menu.open').on("click", function (e) {
                e.preventDefault();
                $('.ui.vertical.sidebar').sidebar('toggle');
            });

            $('.ui.dropdown').dropdown();

        });
    })
    .controller('loginCtrl', function () {
        $(document).ready(function () {
            $('.ui.form')
                .form({
                    fields: {
                        email: {
                            identifier: 'email',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: 'Por favor digite seu e-mail'
                                },
                                {
                                    type: 'email',
                                    prompt: 'Por favor digite um e-mail válido'
                                }
                            ]
                        },
                        password: {
                            identifier: 'password',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: 'Por favor digite a sua senha'
                                }
                            ]
                        }
                    }
                });
        });
    })
    .controller('historicCtrl', function ($scope, HistoricFactory) {

        $scope.months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        var myChart = null;

        function getHistoric(month) {
            return HistoricFactory.query({
                month: month
            }).$promise;
        };

        function getMonthCurrent() {
            var today = new Date();

            return today.getMonth() + 1;
        };

        function getYearCurrent() {
            var today = new Date();

            return today.getYear();
        };

        function getAllDaysOfMonth(month, year) {
            month--;

            var date = new Date(year, month, 1);
            var days = [];
            while (date.getMonth() === month) {
                days.push(date.getDate().toString());
                date.setDate(date.getDate() + 1);
            }

            return days;
        };

        function createData(historicMonth, days) {
            var resultData = [];
            var lastMoney = 0;

            for (day in days) {
                historicMonth.forEach(function (element, index) {

                    var dataElement = new Date(element.data);
                    if (dataElement.getDate() == day) {
                        lastMoney += element.total;
                    }
                });

                resultData.push(lastMoney);
            }

            return resultData;
        };

        function getNameMonthCurrent() {
            return $scope.months[getMonthCurrent() - 1];
        }

        function updateChart(month) {
            getHistoric(month).then(function (historic) {
                var days = getAllDaysOfMonth(month, getYearCurrent());
                var data = createData(historic, days);

                var ctx = document.getElementById("canvas").getContext("2d");

                if (!myChart)
                    myChart = new Chart.Line(ctx, {
                        data: {
                            labels: days,
                            datasets: [{
                                label: 'Fluxo',
                                backgroundColor: "rgba(75,192,192,0.4)",
                                borderColor: "rgba(75,192,192,1)",
                                data: data,
                                fill: false,
                                lineTension: 0.1,
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Fluxo de caixa - Mensal'
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        show: true,
                                        labelString: 'Day'
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        show: true,
                                        labelString: 'Money'
                                    },
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: 30,
                                    }
                                }]
                            }
                        }
                    });
                else {
                    myChart.data.labels = days;
                    myChart.data.datasets[0].data = data;
                    myChart.update();
                }
            });
        }

        $(document).ready(function () {

            $('.dropdown').dropdown('set selected', [getNameMonthCurrent()]);
            $('.dropdown').dropdown({
                onChange: function (value, text, $selectedItem) {
                    updateChart($scope.months.indexOf(text) + 1);
                }
            });

            updateChart(getMonthCurrent());
        });

    })
    .factory('HistoricFactory', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/client/filterHistoric/:month', {month: '@month'});
    }]);