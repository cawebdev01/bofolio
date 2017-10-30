import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { HomeServiceProvider } from '../../providers/home-service/home-service';
import { HomePage } from '../home/home'

@Component({
  selector: 'page-create',
  templateUrl: 'create.html',
})
export class CreatePage {
  types; visible: any; item ={title:'', thumb:'', url:'', tags:'', type:'', desc:'', visible: this.visible} 
  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public homeService: HomeServiceProvider,
  ) {
    this.types= [
      {"value": "Application", "label": "Application"},
      {"value":"Vidéo","label":"Vidéo"},
      {"value":"Photos","label":"Photos"},
      {"value":"Site","label":"Site"}
    ]
  }
  create(){
    if(this.item.visible === true){
      this.item.visible = 1
    }
    else{
      this.item.visible = 0
    }
    console.log(this.item)
    this.homeService.contentposter(this.item)
    this.navCtrl.pop()
  }
}
