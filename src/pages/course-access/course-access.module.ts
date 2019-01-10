import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { CourseAccessPage } from './course-access';

@NgModule({
  declarations: [
    CourseAccessPage,
  ],
  imports: [
    IonicPageModule.forChild(CourseAccessPage),
  ],
})
export class CourseAccessPageModule {}
