/**
 * Created by Glaicon on 28/04/2016.
 */
angular.module("app", [])
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
                                },
                                {
                                    type: 'length[6]',
                                    prompt: 'Sua senha deve ter pelo menos 6 caracteres'
                                }
                            ]
                        }
                    }
                });
        });
    });