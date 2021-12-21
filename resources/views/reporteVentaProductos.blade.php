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
        ¡Hola, {{ auth()->user()->name }}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#128101;</span>
        Reporte Productos
    </h5>

    <div class="container-fluid mb-4">
        <form method="GET" action="{{route('reporte-venta-productos.index')}}" class="row d-flex justify-content-end">
            <!--Input de busqueda-->
            <div class="col-5">
                <input type="text" class="form-control" placeholder="ID del reporte" name="inputBusqueda" value="{{ old('inputBusqueda') }}">
            </div>
            <!--Selector de Mes-->
            <div class="col-auto">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputSelectorMes">Mes</label>
                    <select class="form-select" id="inputSelectorMes" name="inputSelectorMes" value="{{ old('inputSelectorMes') }}">
                        <option value="0" selected>Seleccione un mes...</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
            </div>
            <!--Selector de Año-->
            <div class="col-auto">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputSelectorAnio">Año</label>
                    <select class="form-select" id="inputSelectorAnio" name="inputSelectorAnio" value="{{ old('inputSelectorAnio') }}">
                        <option value="0" selected>Seleccione un año.</option>
                        @foreach($aniosDisponibles as $anio)
                            <option  value="{{$anio->anio}}">{{$anio->anio}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!--Boton de busqueda -->
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
                    @foreach($registrosVista as $venta)
                        <!--Inicio de la Fila-->
                        <tr>
                            <!--ID de la tabla clientes-->    
                            <th scope="col">{{$venta->folio_v}}</th>
                            <!--Los otros atributos de la tabla usuarios-->
                            <td >{{$venta->idusuario}}</td>
                            <td >{{$venta->fechayhora}}</td>
                            <td>
                                <button class="btn btn-information-sales" 
                                    data-url-query="{{ route('ventas.folio',$venta) }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#InformacionModalProductos" >
                                      <span>&#128065;</span>  
                                </button>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$registrosVista->withQueryString()->links()}}
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

<!-- ########################## MODLA DE INFORMACION DE LA VENTA ################################################-->
@component('components.modalSimple')
        @slot('idModal','InformacionModalProductos')
        @slot('tituloModal','Informaicon basica de la venta')
        @slot('cuerpoModal')
            <!-- Cuerpo del modal-->
            <div class="container-information overflow-auto">

            </div>
        @endslot
        @slot('footerModal')
            <!--Pies del modal-->
            <!-- <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
                <span class="me-2">&#10060;</span>
                Cancelar
            </button> -->
            <button type="button" class="btn btn-light d-flex ps-3 pe-3" id="" data-bs-dismiss="modal">
                <span class="me-2">&#10004;</span>
                Aceptar
            </button>
        @endslot
@endcomponent        

@endsection






<!--En esta seccion van los scripts para cada una de las vistas-->
@section('scritps')
    <script type="text/javascript" src="./js/minAjax.js"></script>
    <script src="./js/funciones/informacionProductos.js"></script>
@endsection
