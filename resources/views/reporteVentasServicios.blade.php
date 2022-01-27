@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
<x-header visible=true>
    <x-slot name="items">
        <x-itemsNavBar active="reporteVentas" />
    </x-slot>
</x-header>
@endsection

@section('contenido')

<h5 class="h5 text-star mt-5 ps-3">
    <span>&#128075;</span>
    ¡Hola, {{ auth()->user()->name }}!
</h5>
<h5 class="h5 text-star mt-3 mb-5 ps-3 ">Reporte de Ventas de servicios</h5>

<div class="container-fluid mb-4">
    <form action="" class="row d-flex justify-content-end">
        <div class="col-5">
            <input type="text" class="form-control" placeholder="PlaceHolder">
        </div>
        <!--Selector de mes--->
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
                    <option value="{{$anio->anio}}">{{$anio->anio}}</option>
                    @endforeach
                </select>
            </div>
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
                    @foreach($camposTabla as $campo)
                    <th scope="col">{{$campo}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($registrosVista as $servicio)
                <tr>
                    <td>{{$servicio->idservicio}}</td>
                    <td>{{$servicio->fechayhora}}</td>
                    <td>{{$servicio->iddireccion}}</td>
                    <td>{{$servicio->monto}}</td>
                    <td>{{$servicio->descripcion}}</td>
                    <td>{{$servicio->idcliente}}</td>
                    <td>

                        <button class="btn btn-information-sales" data-url-query="{{ route('servicios.folio',$servicio) }}" data-bs-toggle="modal" data-bs-target="#InformacionModalServicios">
                            <span>&#128065;</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ Secccion de Modales $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- ########################## MODLA DE INFORMACION DE LA VENTA ################################################-->
<x-modalSimple idModal="InformacionModalServicios" tituloModal="Informaicon basica del servicio">
    <x-slot name="cuerpoModal">
        <div class="container-information overflow-auto">

        </div>
    </x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Aceptar" data-bs-dismiss="modal" />
    </x-slot>
</x-modalSimple>
@endsection
@section('scritps')
<script src="./js/funciones/informacionServicios.js"></script>
@endsection