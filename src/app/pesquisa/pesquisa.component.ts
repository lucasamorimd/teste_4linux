import { Component, EventEmitter, OnInit, Output } from "@angular/core";
import { DateAdapter } from "@angular/material/core";
import { Agendamentos } from "app/interfaces/agendamentos";
import { Consultor } from "app/interfaces/consultores";
import { Servicos } from "app/interfaces/servicos";
import { PesquisasService } from "app/requests/pesquisas.service";
import { MatDatepickerInputEvent } from "@angular/material/datepicker";

@Component({
  selector: "app-pesquisa",
  templateUrl: "./pesquisa.component.html",
  styleUrls: ["./pesquisa.component.css"],
})
export class PesquisaComponent implements OnInit {
  listaAgends: Agendamentos;
  listaConsultor: Consultor[];
  listaServico: Servicos[];
  @Output()
  dateChange: EventEmitter<MatDatepickerInputEvent<any>>;

  filtro: any;
  tipo: string;

  private readonly _url = "http://localhost:8081";
  constructor(
    private dateAdapter: DateAdapter<Date>,
    private service: PesquisasService
  ) {
    this.dateAdapter.setLocale("en-GB");
  }

  ngOnInit() {
    this.service
      .listaAgendamentos(this._url)
      .subscribe((dados) => (this.listaAgends = dados));

    this.service
      .listaConsultor(this._url)
      .subscribe((dados) => (this.listaConsultor = dados));
    this.service
      .listaServicos(this._url)
      .subscribe((dados) => (this.listaServico = dados));
    //this.agendamentosLista$ = this.service.listAgendamentos(this._url);
    //this.consultoresLista$ = this.service.listaConsultor(this._url);
  }
  ngOnDestroy() {}
}
