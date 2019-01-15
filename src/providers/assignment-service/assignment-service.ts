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
    /**
     * Observables are functions/types that will wait
     * for a request to finish before completing its task.
     * 
     * <any> denotes the type of variable this function is looking for.
     * 
     * HTTP is the class that will communicate with a server.
     * 
     * PIPE will process the data using established functions,
     * in this case it will tell the app there was a problem, if any.
     */
    return this.http.get('http://localhost/php/subdomains/application/api/assignments-list.php').pipe(
      catchError(error => { return Observable.throw(error); })
    );
  }

}
