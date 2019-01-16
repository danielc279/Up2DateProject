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

  public fetchAssignments(id:any): Observable<any>
  {
    return this.http.request<any>('http://localhost/php/subdomains/application/api/assignment-list.php', id).pipe(
      catchError(error => { return Observable.throw(error); })
    );
  }

}
