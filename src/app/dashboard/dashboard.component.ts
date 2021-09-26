import { Component, OnInit, VERSION } from "@angular/core";
import { Agendamentos } from "app/interfaces/agendamentos";
import { Consultor } from "app/interfaces/consultores";
import { Servicos } from "app/interfaces/servicos";
import { PesquisasService } from "app/requests/pesquisas.service";
import { Observable } from "rxjs";

@Component({
  selector: "app-dashboard",
  templateUrl: "./dashboard.component.html",
  styleUrls: ["./dashboard.component.css"],
})
export class DashboardComponent implements OnInit {
  //agendamentos: Agendamentos[];

  agendamentos$: Observable<Agendamentos[]>;
  consultores$: Observable<Consultor[]>;
  servicos$: Observable<Servicos[]>;

  constructor(private service: PesquisasService) {}
  ngOnInit() {
    //this.service.list().subscribe(dados => this.agendamentos = dados);
    this.agendamentos$ = this.service.listaAgendamentos(
      "http://localhost:8081"
    );
    this.consultores$ = this.service.listaConsultor("http://localhost:8081");
    this.servicos$ = this.service.listaServicos("http://localhost:8081");
  }
}
