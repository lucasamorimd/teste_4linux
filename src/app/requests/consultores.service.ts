import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Consultor } from "app/interfaces/consultores";
import { Servicos } from "app/interfaces/servicos";
import { Feriados } from "app/interfaces/feriados";
import { Observable } from "rxjs";
import { tap } from "rxjs/operators";
import { Agendamentos } from "app/interfaces/agendamentos";

@Injectable({
    providedIn: 'root'
})
export class ConsultoresService {
    private readonly API = "http://localhost:8081/api/consultores";
    constructor(private http: HttpClient) { }
    listConsultores(): Observable<Consultor> {
        return this.http.get<Consultor>(this.API)
            .pipe(
                tap(console.log)
            );
    }
    getServicos(e): Observable<Servicos> {
        let _url: string = `http://localhost:8081/api/servicos-consultor/${encodeURI(e)}`
        return this.http.get<Servicos>(_url)
            .pipe(
                tap(console.log)
            )
    }
    getFeriados(): Observable<Feriados[]> {
        let _url = 'https://brasilapi.com.br/api/feriados/v1/2021'
        return this.http.get<Feriados[]>(_url)
            .pipe(
                tap(console.log)
            );
    }
    getAgendamentos(e): Observable<Agendamentos[]> {
        let url = `http://localhost:8081/api/agendamento/${encodeURI(e)}.consultor`
        return this.http.get<Agendamentos[]>(url)
            .pipe(
                tap(console.log)
            )
    }
}