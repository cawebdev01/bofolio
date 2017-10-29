import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { HomeServiceProvider } from '../../providers/home-service/home-service';
import { CreatePage } from '../create/create';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  items; //collect = "Site";
  constructor(
    public navCtrl: NavController,
    private homeservice : HomeServiceProvider,
  ) {
      this.load()
  }
  load(){
    this.homeservice./*collect*/loader(/*this.collect*/).subscribe(data =>{
      this.items = data
    })
  }
  creator(){
    this.navCtrl.push(CreatePage)
  }
}
