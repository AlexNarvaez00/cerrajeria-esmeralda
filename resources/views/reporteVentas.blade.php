@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
<!--Esta es la prte del boton de log out -->
@component('components.header')
@slot('items')
    @component('components.itemsNavBar')
        @slot('active','reporteVentas')
    @endcomponent
@endslot

<!--Esta parte es para mostrar el boton de log out-->
@slot('visible',true)
@endcomponent
@endsection



@section('contenido')

    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, XXXXXXXXX}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">Reporte de Ventas</h5>

    <div class="container-fluid mb-4">
        <form action="" class="row d-flex justify-content-end">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="PlaceHolder">
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
                        <th scope="col">Clave Venta</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Editado</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">asdcsdc</th>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>
                        <td><span>&#128394;</span></td>
                        <td><span>&#10060;</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
