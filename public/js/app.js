/**
 * Created by Glaicon on 28/04/2016.
 */
angular.module('app', ['ngResource'])
    .constant('appConfig', {
        //baseUrl: 'http://localhost:8000'
         baseUrl: 'http://caderneta.peixer.com'
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
    .controller('registerCtrl', function () {
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
                        },
                        name: {
                            identifier: 'name',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: 'Por favor digite o seu nome'
                                }
                            ]
                        },
                        password_confirmation: {
                            identifier: 'password_confirmation',
                            rules: [
                                {
                                    type: 'match[password]',
                                    prompt: 'As senhas não são iguais'
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
    .controller('reportCtrl', function ($scope, ReportFactory) {

        $scope.tag = '';

        $(document).ready(function () {

            var myPieChart;
            var data;
            var ctx;
            var counter = 0;

            initializeCalendar();

            $scope.addTag = function () {
                if ($scope.tag !== '') {
                    insertLabel();
                    $scope.tag = '';
                }
            };

            function insertLabel() {
                counter++;
                $('.ui.tag.labels')[0].innerHTML += '<a id="label' + counter + '" class="ui label"> #' + $scope.tag + '<i class="delete icon" onclick="remover(' + counter + ')"></i></a>';
            }

            function initializeCalendar() {
                $('#rangestart').calendar({
                    type: 'date',
                    endCalendar: $('#rangeend')
                });

                $('#rangeend').calendar({
                    type: 'date',
                    startCalendar: $('#rangestart')
                });
            }

            function getReport() {
                return ReportFactory.getReport({}, {
                    start: $('#rangestart').data().date.toLocaleDateString(),
                    end: $('#rangeend').data().date.toLocaleDateString(),
                    tags: getTags()
                }).$promise;
            }

            function getSum(data) {
                var result = [];
                var tags = getTags();

                getTags().forEach(function (element, index) {
                    element = element.replace('#', '');

                    var sum = 0;

                    if (data.hasOwnProperty(element)) {
                        var sum = 0;
                        Object.getOwnPropertyDescriptor(data, element).value.forEach(function (elementTag, index) {
                            sum += elementTag.total;
                        });
                    }

                    result.push(sum);
                });

                return result;
            };

            function getSumForTotal(sum) {
                var result = 0;

                sum.forEach(function (element, index) {
                    result += element;
                });

                return result;
            }

            $scope.filter = function () {
                $('.fluid.ui.button').addClass('loading');

                getReport().then(function (data) {

                    var sum = getSum(data);
                    updateChart(sum);
                    $('#totalReport').innerHTML += '<a> ' + getSumForTotal(sum) + '</a>';

                }, function (dataError) {

                });

                $('.fluid.ui.button').removeClass('loading');
            };

            function getTags() {
                var tags = [];

                $('.ui.tag.labels').children().each(function (index) {
                    tags.push($(this).context.innerText);
                });

                return tags;
            }

            function updateChart(sum) {
                myPieChart.data.labels = getTags();
                myPieChart.data.datasets[0].data = sum;

                var colors = getColorRandom(getTags());
                myPieChart.data.datasets[0].backgroundColor = colors;
                myPieChart.data.datasets[0].hoverBackgroundColor = colors;
                myPieChart.update();
            }

            var colorList = ["#FFCE56", "#ff0000", "#40ff00", "#0000ff", "#ff00bf", "#00ffff", "#ffff00", "#000000"]

            function getColorRandom(tags) {
                var colors = [];

                tags.forEach(function (element, index) {
                    colors.push(colorList[index]);
                });

                return colors;
            }

            function initializeChart() {
                ctx = document.getElementById("canvas").getContext("2d");
                data = {
                    labels: [
                        "Red",
                        "Green",
                        "Yellow"
                    ],
                    datasets: [
                        {
                            data: [300, 50, 100],
                            backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56"
                            ],
                            hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56"
                            ]
                        }]
                };

                myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data
                });
            }

            initializeChart();
        });
    })
    .factory('HistoricFactory', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/client/filterHistoric/:month', {month: '@month'});
    }])
    .factory('ReportFactory', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/client/filterReport', {}, {
            getReport: {
                method: 'POST',
                isArray: false
            }
        });
    }]);