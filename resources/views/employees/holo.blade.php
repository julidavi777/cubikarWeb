<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hola</h1>

 <div class="justify-content-md-center formu">
  <div class="row">
    <div class="col-1"></div>
    <div class="col-3">
      <p class="fs-3 my-3">Listado de Empleados</p>
      <p-button
        label="Agregar"
        icon="pi pi-plus"
        iconPos="right"
        routerLink="form-employees"
        class="mb-3"
      ></p-button>
    </div>
    <div class="col-8"></div>
  </div>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
      <ngx-datatable
        class="material mt-2"
        [rows]="rows"
        [headerHeight]="70"
        [footerHeight]="70"
        rowHeight="auto"
        [limit]="10"
        [scrollbarH]="true"
        [loadingIndicator]="loadingIndicator"
      >
        <ngx-datatable-column
          name="identification_type"
          [resizeable]="true"
          [width]="300"
        >
          <ng-template ngx-datatable-header-template> Nombres: </ng-template>
          <ng-template let-row="row" ngx-datatable-cell-template>
            {{employees.name }}
          </ng-template>
        </ngx-datatable-column>

               <ngx-datatable-column name="identification_type" [resizeable]="true"  [width]="300">
        <ng-template ngx-datatable-header-template>
          Apellidos:
        </ng-template>
        <ng-template let-row="row" ngx-datatable-cell-template>
          {{employees.surname }}
        </ng-template>
      </ngx-datatable-column> -->

     <ngx-datatable-column
          name="identification_type"
          [resizeable]="true"
          [width]="300"
        >
          <ng-template ngx-datatable-header-template> Correo: </ng-template>
          <ng-template let-row="row" ngx-datatable-cell-template>
            {{employees.email }}
          </ng-template>
        </ngx-datatable-column>

        <ngx-datatable-column name="rol" [resizeable]="true" [width]="300">
          <ng-template ngx-datatable-header-template> Cargo: </ng-template>
          <ng-template let-row="row" ngx-datatable-cell-template>
            {{ employees.position }}
          </ng-template>
        </ngx-datatable-column>



        <ngx-datatable-column
          name="acciones"
          [resizeable]="false"
          [width]="200"
        >
          <ng-template ngx-datatable-header-template> Acciones: </ng-template>
          <ng-template let-row="row" ngx-datatable-cell-template>
            <ion-buttons class="grid-container " >
              <ion-button
                class="danger"
                (click)="editEmployee(employees.id)"
                data-tooltip="Editar"
                data-tooltip-conf="right"
              >
                <ion-icon class="text-warning" name="pencil"></ion-icon>
              </ion-button>
              <ion-button
              (click)="deleteEmployee(employees.id)"
                data-tooltip="Eliminar"
                data-tooltip-conf="left"
              >
                <ion-icon class="text-danger" name="trash"></ion-icon>
              </ion-button>
            </ion-buttons>
          </ng-template>
        </ngx-datatable-column>
      </ngx-datatable>
    </div>
    <div class="col-1"></div>
  </div>
  <p-toast position="bottom-center" key="deletedMessage"></p-toast>
  <p-toast position="bottom-center" key="errorDeleteMessage"></p-toast>
  <p-confirmDialog
    header="Confirmation"
    icon="pi pi-exclamation-triangle"
  ></p-confirmDialog>
</div>
</body>
</html>

//formControlName
    <div class="mb-3">
        <label for="front" class="form-label"></label>
        @if(isset($employees->front))
        <img class="img-thumbnail img-fluid mb-3" src="{{ asset('storage'.'/'.$employees->front)}}" alt="Portada del libro" width="90">
        @endif
        <input type="file" class="form-control" name="front">
    </div>

    <div class="mb-3 visually-hidden">
        <input type="text" class="form-control" value="true" name="on_stock">
    </div>