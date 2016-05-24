/**
 * Created by Glaicon on 21/05/2016.
 */
import {Page} from 'ionic-angular';

@Page({
    templateUrl: 'build/pages/movimento/TabFavorito/TabFavoritoPage.html'
})
export class TabFavoritoPage {
    constructor() {
        this.items = [];
        for(let i = 1; i < 5; i++) {
            this.items.push({
                title: 'Item ' + i,
                note: 'This is item #' + i,
                icon: 'heart'
            });
        }
    }
}
