import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Storage } from '@ionic/storage';
import { UserService } from '../../providers/user-service/user-service';


@Injectable()
export class AttendanceService
{
  constructor(
    public http: HttpClient,
    public userService: UserService)
  { }

  public fetchAttendances(): Observable<any>
  {
    return this.http.get<any>('http://api.application.local/attended.php').pipe(
      catchError(error => { return Observable.throw(error); })
    );

  }
    public fetchSubjects(): Observable<any>
  {
    return this.http.get<any>('http://api.application.local/attended-subject.php').pipe(
      catchError(error => { return Observable.throw(error); })
    );

  }

}



