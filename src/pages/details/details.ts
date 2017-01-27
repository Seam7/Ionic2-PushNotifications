import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

@Component({
  selector: 'page-details',
  templateUrl: 'details.html'
})
export class DetailsPage {

  public message: any;

  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.message = navParams.get('message');
  }

}
