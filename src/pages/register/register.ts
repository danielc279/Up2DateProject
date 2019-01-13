import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController, LoadingController } from 'ionic-angular';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from '../../providers/user-service/user-service';

/**
 * Generated class for the RegisterPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage({
  name: 'register'
})
@Component({
  selector: 'page-register',
  templateUrl: 'register.html',
  providers: [ UserService ]
})
export class RegisterPage {

  // Form Groups will automate any data and validation
  // in our forms.
  private registerGroup: FormGroup;

  // The submit attempt for the user will start off as
  // false, and we'll switch it on button press.
  private submitAttempt: boolean = false;

  constructor(
    public alertCtrl: AlertController,
    public formBuilder: FormBuilder,
    public loadCtrl: LoadingController,
    public navCtrl: NavController,
    public navParams: NavParams,
    private userService: UserService)
  {
    // this command will set up the form validation.
    this.registerGroup = this.formBuilder.group({
      // the email field is required.
      email: ['', Validators.required],

      // the password field is required.
      password: ['', Validators.required],

      // the name field is required.
      name: ['', Validators.required],

      // the surname field is required.
      surname: ['', Validators.required],

      // the code field is required.
      code: ['', Validators.required]

    });
  }

  // processes and sends the login request.
  public register(): void
  {


    // first, make a submit attempt.
    this.submitAttempt = true;

    // if the form doesn't validate, stop the function.
    if (!this.registerGroup.valid)
    {
      return;
    }

    // Observable functions will only start their code
    // if we write subscribe().
    this.userService.register(this.registerGroup.value).subscribe(
      // we are successful, do the rest.
      data => {
        this.navCtrl.setRoot('login', {}, { animate: true });
      },
      
      // we have an error, handle it.
      error => {

        // if the website didn't log us in, show an alert.
        const alert = this.alertCtrl.create({
          title: 'Register Error',
          subTitle: error.message,
          buttons: [ 'OK' ]
        });
        alert.present();
      }
    );
  }

}
