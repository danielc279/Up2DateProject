import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ModalController, ToastController } from 'ionic-angular';
import { AttendanceDetailsPage } from '../attendance-details/attendance-details';
import { Attended } from '../../assets/classes/attended';
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

  public attendedList: Attended[] = [];
  public subjectList: Subject[] = [];

  constructor(
    public modalCtrl: ModalController,
    public navCtrl: NavController, 
    public navParams: NavParams,
    private attendanceService: AttendanceService,
    public toastCtrl: ToastController) {
  }

  ionViewDidLoad() {
    this.attendanceService.fetchAttendances().subscribe(
      data => {
        this.attendedList = data.attended;
      },

      error => {
        const toast = this.toastCtrl.create({
          message: "The attendances could not be loaded.",
        });
        toast.present();
      }
    )

    this.attendanceService.fetchSubjects().subscribe(
      data => {
        this.subjectList = data.subject;
      },

      error => {
        const toast = this.toastCtrl.create({
          message: "The subjects could not be loaded.",
        });
        toast.present();
      }
    )
  }

  openBasicModal(i) {
    let myModal = this.modalCtrl.create(AttendanceDetailsPage);
    myModal.present();
  }
}
