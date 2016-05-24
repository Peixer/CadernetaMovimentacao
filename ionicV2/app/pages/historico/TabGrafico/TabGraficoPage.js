/**
 * Created by Glaicon on 24/05/2016.
 */
import {Page, NavController} from 'ionic-angular';

@Page({
    templateUrl: 'build/pages/historico/TabGrafico/TabGraficoPage.html'
})
export class TabGraficoPage {
    static get parameters() {
        return [[NavController]];
    }

    constructor(nav) {
        this.nav = nav;
        this.items = [];

       // this.initializeChart();
        this.initializeItems();
    }

    initializeChart() {

        var ctx = document.getElementById('canvas').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data
        });

        var data = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [65, 59, 80, 81, 56, 55, 40],
                }
            ]
        };
    }

    initializeItems() {

        if (this.items != null)
            this.items = [];

        for (let i = 1; i < 11; i++) {
            this.items.push({
                title: 'Item ' + i,
                note: 'This is item #' + i,
                icon: 'md-heart'
            });
        }
    }
}