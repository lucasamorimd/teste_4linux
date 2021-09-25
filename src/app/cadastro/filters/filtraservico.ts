import { Pipe, PipeTransform } from "@angular/core";

@Pipe({
  name: "filtroServico",
})
export class FiltroServicoPipe implements PipeTransform {
  transform(value: Array<any>, filtro: any) {
    if (filtro) {
      return value.filter((a) => a.consultor.id.indexOf(filtro) >= 0);
    }
  }
}
