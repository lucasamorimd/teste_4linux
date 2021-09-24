import { Component, OnInit, VERSION } from '@angular/core';
import { Agendamentos } from 'app/interfaces/agendamentos';
import { AgendamentosService } from 'app/requests/agendamentos.service';
import { Observable } from 'rxjs';


@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  //agendamentos: Agendamentos[];

  agendamentos$: Observable<Agendamentos[]>

  constructor(private service: AgendamentosService) {

  }
  ngOnInit() {
    //this.service.list().subscribe(dados => this.agendamentos = dados);
    this.agendamentos$ = this.service.list()
  }
}
