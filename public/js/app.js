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
    });