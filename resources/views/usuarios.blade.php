@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        <li class="nav-item">
            <a class="nav-link text-dark" href="#">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#">Proveedores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#">Ventas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="#">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#"> 
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
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">Usuarios</h5>

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
                <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
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
@endsection