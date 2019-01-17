import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ModalController, ToastController } from 'ionic-angular';
import { AttendanceDetailsPage } from '../attendance-details/attendance-details';
import { Attended1 } from '../../assets/classes/attended1';
import { Attended2 } from '../../assets/classes/attended2';
import { Attended3 } from '../../assets/classes/attended3';
import { AttendanceService } from '../../providers/attendance-service/attendance-service';
import { Subject } from '../../assets/classes/subject';

@IonicPage({
  name:'attendance'
})
@Component({
  selector: 'page-attendance',
  templateUrl: 'attendance.html',
})
export class AttendancePage {

  public attendedList1: Attended1[] = [];
  public attendedList2: Attended2[] = [];
  public attendedList3: Attended3[] = [];

  constructor(
    public modalCtrl: ModalController,
    public navCtrl: NavController, 
    public navParams: NavParams,
    private attendanceService: AttendanceService,
    public toastCtrl: ToastController) {
  }

  ionViewDidLoad() {
    this.attendanceService.fetchAttendances1().subscribe(
      data => {
        this.attendedList1 = data.attended1;
      },

      error => {
        const toast = this.toastCtrl.create({
          message: "The attendances could not be loaded.",
        });
        toast.present();
      }
    )

    this.attendanceService.fetchAttendances2().subscribe(
      data => {
        this.attendedList2 = data.attended2;
      },

      error => {
        const toast = this.toastCtrl.create({
          message: "The attendances could not be loaded.",
        });
        toast.present();
      }
    )

    this.attendanceService.fetchAttendances3().subscribe(
      data => {
        this.attendedList3 = data.attended3;
      },

      error => {
        const toast = this.toastCtrl.create({
          message: "The attendances could not be loaded.",
        });
        toast.present();
      }
    )
  }

  openBasicModal() {
    let myModal = this.modalCtrl.create(AttendanceDetailsPage);
    myModal.present();
  }
}
