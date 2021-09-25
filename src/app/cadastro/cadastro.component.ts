import { Component, OnInit } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { Router } from "@angular/router";
import { Agendamentos } from "app/interfaces/agendamentos";
import { Consultor } from "app/interfaces/consultores";
import { Feriados } from "app/interfaces/feriados";
import { Servicos } from "app/interfaces/servicos";
import { AgendamentosService } from "app/requests/agendamentos.service";
import { ConsultoresService } from "app/requests/consultores.service";
import { Observable } from "rxjs";

@Component({
  selector: "app-cadastro",
  templateUrl: "./cadastro.component.html",
  styleUrls: ["./cadastro.component.css"],
})
export class CadastroComponent implements OnInit {
  consultores$: Observable<Consultor>;
  servicos$: Observable<Servicos>;
  feriados$: Observable<Feriados[]>;
  agendamentos$: Observable<Agendamentos[]>;
  id_consultor: number;
  form: FormGroup;
  inputdata: any;
  is_submited = false;

  notify: string;

  constructor(
    private service: ConsultoresService,
    private fb: FormBuilder,
    private agendservice: AgendamentosService,
    private router: Router
  ) {}

  ngOnInit() {
    this.consultores$ = this.service.listConsultores();
    this.feriados$ = this.service.getFeriados();
    this.form = this.fb.group({
      consultor: [[Validators.required, Validators.maxLength(250)]],
      servico: [[Validators.required, Validators.maxLength(250)]],
      data: [null],
      email_cliente: [
        null,
        [Validators.required, Validators.maxLength(250), Validators.email],
      ],
    });
  }
  getConsultorServicos(value) {
    if (value) {
      this.servicos$ = this.service.getServicos(value);
      this.id_consultor = value;
      this.agendamentos$ = this.agendservice.list();
    }
  }
  receberData(data) {
    let date: any;
    let month: any;
    if (data.getDate().toString().length < 2) {
      date = "0" + data.getDate().toString();
    } else {
      date = data.getDate().toString();
    }

    if ((data.getMonth() + 1).toString().length < 2) {
      month = "0" + (data.getMonth() + 1).toString();
    } else {
      month = (data.getMonth() + 1).toString();
    }

    const day = `${data.getFullYear().toString()}-${month}-${date}`;
    this.inputdata = day;
  }

  onSubmit() {
    this.form.value.data = this.inputdata;
    if (this.form.valid && this.form.value.data) {
      this.notify = "Enviando formulário";
      this.is_submited = true;
      this.agendservice.create(this.form.value).subscribe(
        (success) => {
          console.log(success);
          this.notify = "Agendamento cadastrado!";
        },
        (error) => (this.notify = `${error.error}`),
        () => this.router.navigate(["/", "dashboard"])
      );
    }
  }
}
