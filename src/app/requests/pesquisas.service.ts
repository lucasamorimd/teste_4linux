import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Agendamentos } from "app/interfaces/agendamentos";
import { Consultor } from "app/interfaces/consultores";
import { Servicos } from "app/interfaces/servicos";
import { tap, map } from "rxjs/operators";
import { Observable } from "rxjs";

@Injectable({
  providedIn: "root",
})
export class PesquisasService {
  constructor(private http: HttpClient) {}
  listAgendamentos(dominio: string) {
    let url = `${encodeURI(dominio)}/api/agendamento`;
    return this.http.get<Agendamentos[]>(url).pipe(tap(console.log));
  }

  listaConsultor(dominio: string) {
    let url = `${encodeURI(dominio)}/api/consultores`;
    return this.http.get<Consultor[]>(url).pipe(tap(console.log));
  }

  listaServicos(dominio: string) {
    let url = `${encodeURI(dominio)}/api/servicos`;
    return this.http.get<Servicos[]>(url).pipe(tap(console.log));
  }
}
