import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class HomeServiceProvider {
  url : String
  constructor(public http: Http) {  
    this.url = "http://www.arcamonecreations.fr/"
  }
  loader(){
    return this.http.get(this.url + 'dataretriever.php').map((res: Response)=>res.json())
  }
  collectloader(collect){
    return this.http.get(this.url + 'dataretriever.php?collect='+collect).map((res: Response)=>res.json())
  }
  contentposter(credentials){
    let body : string = "key=create&title="+credentials.title+"&thumb="+credentials.thumb+"&url="+credentials.url+"&tags="+credentials.tags+"&type="+credentials.type+"&description="+credentials.desc+"&visible="+credentials.visible,
        type : string ="application/x-www-form-urlencoded; charset=UTF-8",
        header : any = new Headers({ 'Content-Type': type}),
        options : any = new RequestOptions({ headers: header}),
        url : any = "http://localhost:8888/php/datamanager.php";
    
    this.http.post(url, body, options).subscribe((data)=>{
      if(data.status === 200){
        console.log("c'est envoyé!")
      }
      else {
        console.log("Oups!!! un problème!")
      }
    })
  }
  contentdeleter(id){
    let body   : string = "key=delete&recordID=" + id,
    type       : string = "application/x-www-form-urlencoded; charset=UTF-8",
    headers    : any    = new Headers({ 'Content-Type': type}),
    options    : any    = new RequestOptions({ headers: headers }), 
    url        : any    = "http://localhost:8888/php/datamanager.php";
    this.http.post(url, body, options).subscribe(data =>{
      if(data.status === 200){
        console.log("c'est supprimé!")
      }
      else {
        console.log("Oups!!! un problème!")
      }
    })
  }
  contentupdater(credentials){

  }
}
