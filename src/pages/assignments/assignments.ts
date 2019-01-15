import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ModalController, ToastController } from 'ionic-angular';
import { AssignmentDetailsPage } from '../assignment-details/assignment-details';
import { Assignment } from '../../assets/classes/assignment';
import { AssignmentService } from '../../providers/assignment-service/assignment-service';

@IonicPage({
  name:'assignments'
})
@Component({
  selector: 'page-assignments',
  templateUrl: 'assignments.html',
})
export class AssignmentsPage {

  public assignmentList: Assignment[] = [];

  constructor(
    public modalCtrl: ModalController,
    public navCtrl: NavController, 
    public navParams: NavParams,
    private assignmentService: AssignmentService,
    public toastCtrl: ToastController) {
  }

  ionViewDidLoad() {
    this.assignmentService.fetchAssignments().subscribe(
      data => {
        this.assignmentList = data;
      },

      error => {
        const toast = this.toastCtrl.create({
          message: "The assignments could not be loaded.",
        });
        toast.present();
      }
    )
  }

  openBasicModal() {
    let myModal = this.modalCtrl.create(AssignmentDetailsPage);
    myModal.present();
  }
}
