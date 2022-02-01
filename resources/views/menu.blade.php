@extends('rootview')


@section('header-seccion')
<x-header visible=false>
    <x-slot name="items">
      <li class="nav-item">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="btn btn-link text-dark fs-5">Cerrar sesión</button>
        </form>
      </li>
    </x-slot>
</x-header>
@endsection

@section('contenido')
<!-- Elementos que muestran la información de la persona previamente al Log In -->
<h5 class="h5 text-star mt-5 ps-3">
    <span>&#128075;</span>
    ¡Hola, {{ auth()->user()->name}}!
</h5>

<div class="container mt-2">
    <h2 class="h2 text-center mb-4">Ménu</h2>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img1.jpg" class="card-img-top img-menu" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <p class="card-text">En esta sección puedes administrar los productos. Agregar, eliminar y modificar.</p>
                        <a href="../productos" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img2.jpeg" class="card-img-top img-menu" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Proveedores</h5>
                        <p class="card-text">En esta sección puedes administrar a los proveedores. Agregar, eliminar y modificar.</p>
                        <a href="../proveedores" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/clientes.jpeg" class="card-img-top img-menu" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">En esta sección puedes administrar a los clientes. Agregar, eliminar y modificar.</p>
                        <a href="../clientes" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img3.jpg" class="card-img-top img-menu" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Reporte de Ventas</h5>
                        <p class="card-text">En esta sección puedes consultar la sección de reportes. Visualiza los reportes de ventas.</p>
                        <a href="../ventas" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#irreportes">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/ventas.png" class="card-img-top img-menu" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ventas</h5>
                        <p class="card-text">En esta sección puedes realizar ventas. Realiza ventas de servicios y productos.</p>
                        <a href="../ventas" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#irventas">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>
        @if(auth()->user()->rol == "Administrador")
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img4.jpg" class="card-img-top img-menu" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">En esta sección puedes administrar a los usuarios. Agregar, eliminar y modificar.</p>
                        <a href="../usuarios" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>
        @endif
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img5.jpg" class="card-img-top img-menu" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Notificaciones</h5>
                        <p class="card-text">En esta sección puedes consultar las notificaciones sobre los productos.</p>
                        <a href="../notificaciones" class="btn btn-primary mb-1">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

    </div>
</div>

    @component('components.modal')
        @slot('idModal','irventas')
        @slot('tituloModal','¿Vas a realizar una venta?')
        /**Agregar estas dos cosas a sus modales*/
            @slot('rutaEnvio','')
            @slot('metodoFormulario','')
        /**Fin de los nuevo */
        @slot('cuerpoModal')
        <div class="container">
        <div class="row">
        <div class="row cards" style="width: auto; margin: auto auto;">

            <div class="col-1">           
                <div class="card" style="width: 18rem;">
                    <img src="./img/productoscerrajeria.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Venta de productos</h5>
                        <p class="card-text">¿Quieres realizar ventas de productos?</p>
                        <a href="../productos-ventas" class="btn btn-primary">Ir</a>
                    </div>
                </div>
                </div>
            </div>           

            <div class="col-6">
                <div class="container mt-2">
                    <div class="card" style="width: 18rem;">
                        <img src="./img/serviciocerrajeria.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Venta de servicio</h5>
                            <p class="card-text">¿Quieres realizar ventas de un servicio?</p>
                            <a href="../servicios-ventas" class="btn btn-primary">Ir</a>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        </div>
        
        @endslot
        @slot('footerModal')
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cerrar
        </button>        
    @endslot
    @endcomponent





@component('components.modalSimple')
        @slot('idModal','irreportes')
        @slot('tituloModal','¿Vas a realizar una Consulta?')
        /**Agregar estas dos cosas a sus modales*/
            @slot('rutaEnvio','')
            @slot('metodoFormulario','')
        /**Fin de los nuevo */
        @slot('cuerpoModal')
        <div class="container">
        <div class="row">
        <div class="row cards" style="width: auto; margin: auto auto;">

            <div class="col-1">           
                <div class="card" style="width: 18rem;">
                    <img src="./img/productoscerrajeria.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Reporte de productos</h5>
                        <p class="card-text">¿Quieres realizar consultas sobre la venta de productos?</p>
                        <a href="../reporte-venta-productos" class="btn btn-primary">Ir</a>
                    </div>
                </div>
                </div>
            </div>           

            <div class="col-6">
                <div class="container mt-2">
                    <div class="card" style="width: 18rem;">
                        <img src="./img/serviciocerrajeria.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Reporte de servicio</h5>
                            <p class="card-text">¿Quieres realizar consultas sobre la ventas de un servicio?</p>
                            <a href="../reporte-ventas-servicios" class="btn btn-primary">Ir</a>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        </div>
        
        @endslot
        @slot('footerModal')
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal2">
            <span class="me-2">&#10060;</span>
            Cerrar
        </button>        
    @endslot
    @endcomponent


@endsection


<!--

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Vistaso rápido</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Notificaciones de productos a reabastecer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                     Aqui va el mensaje, tal vez se pueda con una variable poner el número no sé 
<p>¡Que bien!, no tienes notificaciones.</p>
</div>
</div>
</div>
</div>
-->