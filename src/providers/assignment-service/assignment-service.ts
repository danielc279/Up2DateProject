import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Storage } from '@ionic/storage';
import { UserService } from '../../providers/user-service/user-service';


@Injectable()
export class AssignmentService
{
  constructor(
    public http: HttpClient,
    public userService: UserService)
  { }

  public fetchAssignments(): Observable<any>
  {
    return this.http.get('http://localhost/php/subdomains/application/api/assignments-list.php').pipe(
      catchError(error => { return Observable.throw(error); })
    );
  }

}
