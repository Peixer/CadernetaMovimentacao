/**
 * Created by Glaicon on 24/05/2016.
 */
import {Page} from 'ionic-angular';
import {FilterPage} from '../relatorio/filter/filterPage';

@Page({
    templateUrl: 'build/pages/relatorio/relatorioPage.html'
})
export class RelatorioPage {

    constructor() {
        this.tab1 = FilterPage;
        this.tab2 = FilterPage;
        this.tab3 = FilterPage;
    }
}