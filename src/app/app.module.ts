import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';

import { MyApp } from './app.component';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { UserService } from '../providers/user-service/user-service';
import { HttpClientModule } from '@angular/common/http';
import { IonicStorageModule } from '@ionic/storage';
import { AttendanceDetailsPageModule } from '../pages/attendance-details/attendance-details.module';
import { AssignmentDetailsPageModule } from '../pages/assignment-details/assignment-details.module';
import { AssignmentService } from '../providers/assignment-service/assignment-service';
import { AttendanceService } from '../providers/attendance-service/attendance-service';

@NgModule({
  declarations: [
    MyApp,
  ],
  imports: [
    BrowserModule,
    IonicModule.forRoot(MyApp, { mode: 'md' }),
    HttpClientModule,
    IonicStorageModule.forRoot(),
    AttendanceDetailsPageModule,
    AssignmentDetailsPageModule
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    UserService,
    AssignmentService,
    AttendanceService

  ]
})
export class AppModule {}
