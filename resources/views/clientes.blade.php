@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        <li class="nav-item">
            <a class="nav-link" href="../productos">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="../clientes">clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../proveedores">Proveedores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../ventas">Ventas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../usuarios">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../notificaciones"> 
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
        <span>&#127991;</span>
        Clientes
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
                <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroClienteModal">
                    <span class="me-3">&#10133;</span>
                    Agregar
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
                </tbody>
            </table>
        </div>
    </div>
    @component('components.modal')
    @slot('idModal','registroClienteModal')
    @slot('tituloModal','Registrar un nuevo cliente')
    @slot('cuerpoModal')
        <p class="px-3">
            Modulo para registrar un cliente
        </p>
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre del cliente</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Número de teléfono</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
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