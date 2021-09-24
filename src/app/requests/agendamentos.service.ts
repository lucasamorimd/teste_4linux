import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Agendamentos } from "app/interfaces/agendamentos";
import { Observable } from "rxjs";
import { take, tap } from "rxjs/operators";

@Injectable({
  providedIn: "root",
})
export class AgendamentosService {
  private readonly API = "http://localhost:8081/api/agendamento";
  constructor(private http: HttpClient) {}

  list(): Observable<Agendamentos[]> {
    return this.http.get<Agendamentos[]>(this.API).pipe(tap(console.log));
  }
  create(agendamento) {
    return this.http.post(this.API, agendamento).pipe(take(1));
  }
}
