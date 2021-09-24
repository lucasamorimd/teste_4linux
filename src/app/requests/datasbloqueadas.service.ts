import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Agendamentos } from "app/interfaces/agendamentos";
import { Feriados } from "app/interfaces/feriados";
import { Observable } from "rxjs";
import { tap } from "rxjs/operators";

@Injectable({
    providedIn: 'root'
})
export class DatasbloqueadasService {
    private readonly API = "https://brasilapi.com.br/api/feriados/v1/2021";
    constructor(private http: HttpClient) { }
    list(): Observable<Feriados> {
        return this.http.get<Feriados>(this.API)
            .pipe(
                tap(console.log)
            );
    }
}