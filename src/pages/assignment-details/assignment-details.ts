import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController } from 'ionic-angular';

/**
 * Generated class for the AssignmentDetailsPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage({
  name: 'Subject'
})
@Component({
  selector: 'page-assignment-details',
  templateUrl: 'assignment-details.html',
})
export class AssignmentDetailsPage {

  public assignment = [
    {
      duedate: 'Subject 1',
      assignment: 'agag'
    }
  ];
  constructor(
    public viewCtrl: ViewController,
    public navCtrl: NavController, 
    public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AssignmentsDetailsPage');
  }

  dismiss() {
    this.viewCtrl.dismiss();
  }
}
