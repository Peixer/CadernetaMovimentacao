import {Page} from 'ionic-angular';
import {TabGraficoPage} from '../historico/TabGrafico/TabGraficoPage';
import {TabHistoricoListaPage} from '../historico/TabLista/TabHistoricoListaPage';

@Page({
    templateUrl: 'build/pages/historico/historicoPage.html'
})
export class HistoricoPage {

    constructor() {
        this.tab1 = TabHistoricoListaPage;
        this.tab2 = TabGraficoPage;
    }
}