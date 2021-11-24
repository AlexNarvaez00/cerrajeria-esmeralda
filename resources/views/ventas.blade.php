@extends('rootview')


@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        <li class="nav-item">
            <a class="nav-link" href="../productos">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../proveedores">Proveedores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="../ventas">Ventas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../usuarios">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="../notificaciones"> 
                    <span class="icon">&#128276;</span> 
                    Notificaciones
            </a>
        </li>
    @endslot
  
    <!--Esta parte es para mostrar el boton de log out-->
    @slot('visible',true)
  @endcomponent
@endsection

@section('contenido')

<h5 class="h5 text-star mt-5 ps-3">
    <span>&#128075;</span> 
    ¡Hola, XXXX XXXX XXXX!
</h5>

<h5 class="h5 text-star mt-3 mb-5 ps-3 ">
    <span>&#128722;</span>
    Ventas
</h5>

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
        <div class="col-auto">
            <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroVentasModal">
                <span class="me-3">&#10133;</span>
                Agregar
            </button>
        </div>
    </form>
</div>

<!-- <div class="row">
    <div class="col-5"></div>
    <div class="col-3">
        <input type="text" class="form-control" placeholder="PlaceHolder">
    </div>
    <button type="button" class="btn btn-light col-1">&#128269; Buscar</button>
    <button type="button" class="btn btn-light col-1">&#9547; Agregar</button>
</div> -->

<div class="row">
    <div class="col-12 col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Campo 1</th>
                    <th scope="col">Campo 2</th>
                    <th scope="col">Campo 3</th>
                    <th scope="col">Campo 4</th>
                    <th scope="col">Campo 5</th>
                    <th scope="col">Campo 6</th>
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
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
                    <td><span>&#128394;</span></td>
                    <td><span>&#10060;</span></td>
                </tr>
                <tr>
                    <th scope="row">asdcsdc</th>
                    <td>asdcsdc</td>
                    <td>asdcsdc</td>
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

@component('components.modal')
    @slot('idModal','registroVentasModal')
    @slot('tituloModal','Registrar una venta.')
    @slot('cuerpoModal')
        <p class="px-3">
            Formulario para el registro de ventas.
        </p>
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Fecha</span>
                        <input id="fecha" type="date" value="<?php echo date("Y-n-j"); ?>"> <!
                    </div>
                </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Folio</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
             </div>
             <div class="row">
                <div class="input-group mb-3 col-md-12 col-sm-12">
                    <span class="input-group-text" id="basic-addon1">Id Usuario</span>
                    <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                </div>
             </div> 
             <div class="row">
                <div class="input-group mb-3 col-md-12 col-sm-12">
                    <span class="input-group-text" id="basic-addon1">ID Cliente</span>
                    <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div> 
        </div>
    @endslot
    @slot('footerModal')
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <button type="button" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Registrar
        </button>
    @endslot
    @endcomponent
@endsection