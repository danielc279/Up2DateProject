import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController } from 'ionic-angular';

/**
 * Generated class for the AttendanceDetailsPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-attendance-details',
  templateUrl: 'attendance-details.html',
})
export class AttendanceDetailsPage {
  
  public missed = [
    {
      date: '16/1/2019'
    },
    {
      date: '5/12/2018'
    },
    {
      date: '12/1/2019'
    },
    {
      date: '11/1/2019'
    },
    {
      date: '16/1/2019'
    }
  ];
  constructor(
    public viewCtrl: ViewController,
    public navCtrl: NavController, 
    public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AttendanceDetailsPage');
  }

  dismiss() {
    this.viewCtrl.dismiss();
  }
}
