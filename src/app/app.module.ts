import { BrowserAnimationsModule } from "@angular/platform-browser/animations";
import { NgModule } from "@angular/core";
import { FormsModule, ReactiveFormsModule } from "@angular/forms";
import { HttpClientModule } from "@angular/common/http";
import { RouterModule } from "@angular/router";

import { AppRoutingModule } from "./app.routing";
import { ComponentsModule } from "./components/components.module";

import { AppComponent } from "./app.component";

import { DashboardComponent } from "./dashboard/dashboard.component";
import { AgendamentosService } from "./requests/agendamentos.service";

import { TableListComponent } from "./table-list/table-list.component";

import { AdminLayoutComponent } from "./layouts/admin-layout/admin-layout.component";
import { CadastroComponent } from "./cadastro/cadastro.component";
import { MatDatepickerModule } from "@angular/material/datepicker";
import { MatNativeDateModule } from "@angular/material/core";
import { MatFormFieldModule } from "@angular/material/form-field";
import { MatInputModule } from "@angular/material/input";
import { DatepickerComponent } from "./datepicker/datepicker.component";
import { CommonModule } from "@angular/common";
import { PesquisaComponent } from "./pesquisa/pesquisa.component";
import { FiltroAgendamentoPipe } from "./pesquisa/filters/filtroagendamento";
import { FiltroServicoPipe } from "./cadastro/filters/filtraservico";

@NgModule({
  imports: [
    BrowserAnimationsModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    ComponentsModule,
    RouterModule,
    AppRoutingModule,
    MatDatepickerModule,
    MatFormFieldModule,
    MatNativeDateModule,
    MatInputModule,
    CommonModule,
  ],
  declarations: [
    AppComponent,
    AdminLayoutComponent,
    CadastroComponent,
    DatepickerComponent,
    PesquisaComponent,
    FiltroAgendamentoPipe,
    FiltroServicoPipe,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
