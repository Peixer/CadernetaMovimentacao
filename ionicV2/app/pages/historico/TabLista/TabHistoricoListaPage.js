/**
 * Created by Glaicon on 21/05/2016.
 */
import {Page, NavController} from 'ionic-angular';

@Page({
    templateUrl: 'build/pages/historico/TabLista/TabHistoricoListaPage.html'
})
export class TabHistoricoListaPage {
    static get parameters() {
        return [[NavController]];
    }

    constructor(nav) {
        this.nav = nav;

        this.items = [];
        this.itemsData = [];

        this.initializeItems();
    }

    initializeItems() {

        if (this.items != null)
            this.items = [];

        for (let i = 1; i < 11; i++) {
            this.items.push({
                title: 'Item ' + i,
                note: i + '$',
                icon: 'md-heart',
            });


            this.itemsData.push({
                data: '24/05/2016',
                items: this.items
            })
        }
    }
}