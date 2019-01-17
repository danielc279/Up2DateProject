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

  public fetchAttendances1(): Observable<any>
  {
    return this.http.get<any>('http://api.application.local/attended1.php').pipe(
      catchError(error => { return Observable.throw(error); })
    );

  }
  public fetchAttendances2(): Observable<any>
  {
    return this.http.get<any>('http://api.application.local/attended2.php').pipe(
      catchError(error => { return Observable.throw(error); })
    );

  }
  public fetchAttendances3(): Observable<any>
  {
    return this.http.get<any>('http://api.application.local/attended3.php').pipe(
      catchError(error => { return Observable.throw(error); })
    );

  }
}



