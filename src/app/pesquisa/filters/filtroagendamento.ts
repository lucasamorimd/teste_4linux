import { Pipe, PipeTransform } from "@angular/core";

@Pipe({
  name: "filtroAgendamento",
})
export class FiltroAgendamentoPipe implements PipeTransform {
  transform(value: Array<any>, filtro: any, tipo: string) {
    if (filtro) {
      if (tipo === "consultor") {
        return value.filter((a) => a.consultor.id.indexOf(filtro) >= 0);
      } else if (tipo === "servico") {
        return value.filter((a) => a.servico.id.indexOf(filtro) >= 0);
      } else if (tipo == "data") {
        let date: any;
        let month: any;
        let d = filtro;
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
        return value.filter((a) => a.data.indexOf(day) >= 0);
      }
    } else {
      return value;
    }
  }
}
