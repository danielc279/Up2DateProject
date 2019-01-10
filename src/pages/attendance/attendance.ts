import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ModalController } from 'ionic-angular';
import { AttendanceDetailsPage } from '../attendance-details/attendance-details';

@IonicPage({
  name: 'attendance'
})
@Component({
  selector: 'page-attendance',
  templateUrl: 'attendance.html',
})
export class AttendancePage {

  public attendance = [
    {
      subject: 'Subject 1',
      attendance: 0.8
    },
    {
      subject: 'Subject 2',
      attendance: 0.7
    },
    {
      subject: 'Subject 3',
      attendance: 0.34
    },
    {
      subject: 'Subject 3',
      attendance: 0.34
    },
    {
      subject: 'Subject 3',
      attendance: 0.34
    }
  ];

  constructor(
    public modalCtrl: ModalController,
    public navCtrl: NavController, 
    public navParams: NavParams
    ) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AttendancePage');
  }

  openBasicModal() {
    let myModal = this.modalCtrl.create(AttendanceDetailsPage);
    myModal.present();
  }

}
