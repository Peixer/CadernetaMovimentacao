import {Page} from 'ionic-angular';
import {TabListaPage} from '../movimento/TabLista/TabListaPage';
import {TabFavoritoPage} from '../movimento/TabFavorito/TabFavoritoPage';

@Page({
    templateUrl: 'build/pages/movimento/MovimentoPage.html'
})
export class HistoricoPage {
    
    constructor() {
        this.tab1 = TabListaPage;
        this.tab2 = TabFavoritoPage;
    }
}