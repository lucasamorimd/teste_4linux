import { Component, Input, Output, OnInit, EventEmitter } from "@angular/core";
import { MatDatepickerInputEvent } from "@angular/material/datepicker";
import { DateAdapter } from "@angular/material/core";

@Component({
  selector: "app-datepicker",
  templateUrl: "./datepicker.component.html",
  styleUrls: ["./datepicker.component.css"],
})
export class DatepickerComponent implements OnInit {
  @Input() feriados = [];
  @Input() agendamentos: any;
  @Input() id_consultor: number;
  @Output()
  dateChange: EventEmitter<MatDatepickerInputEvent<any>> = new EventEmitter();
  constructor(private dateAdapter: DateAdapter<Date>) {
    this.dateAdapter.setLocale("en-GB");
  }

  ngOnInit(): void {}
  enviarData(event) {
    this.dateChange.emit(event.target.value);
  }
  myFilter = (e: Date | null): boolean => {
    console.log(this.id_consultor);
    console.log(this.agendamentos);
    let datasblockferiados = [];
    let datasblockagend = [];
    const d = e || new Date();
    let date: any;
    let month: any;
    let agend = this.agendamentos;

    for (let i = 0; i < this.feriados.length; i++) {
      datasblockferiados[i] = this.feriados[i].date;
    }

    if (agend && !agend.error && agend.result.length > 0) {
      datasblockagend = agend.result.map((e) => {
        if (e.consultor.id == this.id_consultor) {
          return e.data;
        }
      });
    }
    console.log(datasblockferiados);
    if (d.getDate().toString().length < 2) {
      date = "0" + d.getDate().toString();
    } else {
      date = d.getDate().toString();
    }

    if ((d.getMonth() + 1).toString().length < 2) {
      month = "0" + (d.getMonth() + 1).toString();
    } else {
      month = (d.getMonth() + 1).toString();
    }

    const day = d.getFullYear().toString() + "-" + month + "-" + date;

    return (
      !datasblockferiados.includes(day) &&
      !datasblockagend.includes(day) &&
      d.getDay() !== 0 &&
      d.getDay() !== 6
    );
  };
}
