import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ModalController } from 'ionic-angular';
import { AssignmentDetailsPage } from '../assignment-details/assignment-details';

@IonicPage({
  name:'assignments'
})
@Component({
  selector: 'page-assignments',
  templateUrl: 'assignments.html',
})
export class AssignmentsPage {

  public assignment = [
    {
      duedate: '16/1/2019',
      assignment: '10 Models'
    },
    {
      duedate: '16/1/2019',
      assignment: '10 Models'
    },
    {
      duedate: '16/1/2019',
      assignment: '10 Models'
    },
    {
      duedate: '16/1/2019',
      assignment: '10 Models'
    },
    {
      duedate: '16/1/2019',
      assignment: '10 Models'
    }
  ];

  constructor(
    public modalCtrl: ModalController,
    public navCtrl: NavController, 
    public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AssignmentsPage');
  }

  openBasicModal() {
    let myModal = this.modalCtrl.create(AssignmentDetailsPage);
    myModal.present();
  }
}
