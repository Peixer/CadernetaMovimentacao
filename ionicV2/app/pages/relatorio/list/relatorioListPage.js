/**
 * Created by Glaicon on 24/05/2016.
 */
import {Page, NavController} from 'ionic-angular';

@Page({
    templateUrl: 'build/pages/relatorio/list/relatorioListPage.html'
})
export class FilterPage {
    static get parameters() {
        return [[NavController]];
    }

    constructor(nav) {
        this.nav = nav;
    }
}