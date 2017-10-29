import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class HomeServiceProvider {

  constructor(public http: Http) {  }
  loader(){
    return this.http.get('http://localhost:8888/php/dataretriever.php').map((res: Response)=>res.json())
  }
  collectloader(collect){
    return this.http.get('http://localhost:8888/php/dataretriever.php?collect='+collect).map((res: Response)=>res.json())
  }
}
