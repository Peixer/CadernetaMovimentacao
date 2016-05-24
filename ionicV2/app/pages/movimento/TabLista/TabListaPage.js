/**
 * Created by Glaicon on 21/05/2016.
 */
import {Page, NavController} from 'ionic-angular';

@Page({
    templateUrl: 'build/pages/movimento/TabLista/TabListaPage.html'
})
export class TabListaPage {
    static get parameters() {
        return [[NavController]];
    }

    constructor(nav) {
        this.nav = nav;

        this.searchQuery = '';
        this.items = [];

        this.initializeItems();
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

    clickIcon(event, item) {
        var element = event.srcElement;

        if (element.classList.contains('md-heart')) {
            element.classList.remove('md-heart');
            element.classList.add('md-heart-broken');
        } else {
            element.classList.remove('md-heart-broken');
            element.classList.add('md-heart');
        }
    }

    getItems(searchbar) {

        this.initializeItems();

        var q = searchbar.value;

        if (q.trim() == '') {
            return;
        }

        this.items = this.items.filter((v) => {
            if (v.title.toLowerCase().indexOf(q.toLowerCase()) > -1) {
                return true;
            }

            return false;
        });
    }
}