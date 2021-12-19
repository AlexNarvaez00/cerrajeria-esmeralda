@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
<!--Esta es la prte del boton de log out -->
@component('components.header')
@slot('items')
    @component('components.itemsNavBar')
        @slot('active','Reportes')
    @endcomponent
@endslot

<!--Esta parte es para mostrar el boton de log out-->
@slot('visible',true)
@endcomponent
@endsection



@section('contenido')
    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, {{ $nombreUsuarioVista }}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#128101;</span>
        Reporte Productos
    </h5>

    <div class="container-fluid mb-4">
        <form method="GET" action="{{route('reporteProductos.index')}}" class="row d-flex justify-content-end">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="ID del reporte" name="inputBusqueda">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                    <span class="me-3">&#128269</span>  
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <!--Seccion de la tabla-->
    <div class="conteiner-fluid">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <!--
                        Campos de la tabla
                        -->
                        @foreach ($camposVista as $campo)
                            <th scope="col">{{$campo}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!--Aqui van los registros-->
                    @foreach($registrosVista as $reporteProductos)
                        <!--Inicio de la Fila-->
                        <tr>
                            <!--ID de la tabla clientes-->    
                            <th scope="col">{{$reporteProductos->folio_v}}</th>
                            <!--Los otros atributos de la tabla usuarios-->
                            <td class="data">{{$reporteProductos->clave_producto}}</td>
                            <td class="data">{{$reporteProductos->observaciones}}</td>
                            <td class="data">{{$reporteProductos->fechayhora}}</td>
                            <!--Botones-->
                            <td>
                            <button class="btn" data-id-db="{{$reporteProductos->folio_v}}">
                                <span>&#128394;</span>
                            </button>
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
   
@component('components.modalSimple')
        @slot('idModal','confirmacionModal')
        @slot('tituloModal','¿Seguro que quieres borrar este registro?')
        @slot('cuerpoModal')
            <!-- Cuerpo del modal-->
        @endslot
        @slot('footerModal')
            <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
                <span class="me-2">&#10060;</span>
                Cancelar
            </button>
            <button type="submit" class="btn btn-light d-flex ps-3 pe-3" id="botonModalConfirmacion">
                <span class="me-2">&#10004;</span>
                Confirmar
            </button>
        @endslot
    @endcomponent
@endsection


<!--En esta seccion van los scripts para cada una de las vistas-->
@section('scritps')
   
@endsection
