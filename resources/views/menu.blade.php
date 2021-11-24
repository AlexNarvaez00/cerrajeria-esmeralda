@extends('rootview')


@section('header-seccion')
@component('components.header')
<!--Items de la barra de menu-->
@slot('items')
@endslot
<!--Esta parte es para mostrar el boton de log out-->
@slot('visible',true)
@endcomponent
@endsection

@section('contenido')
<!-- Elementos que muestran la información de la persona previamente al Log In -->
<h5 class="h5 text-star mt-5 ps-3">
    <span>&#128075;</span>
    ¡Hola, XXXX XXXX XXXX!
</h5>

<div class="container mt-2">
    <h2 class="h2 text-center mb-4">Ménu</h2>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <p class="card-text">Podras acceder a las ediciones comunes.</p>
                        <a href="../productos" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img2.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Proveedores</h5>
                        <p class="card-text">Podras acceder a las ediciones comunes.</p>
                        <a href="../proveedores" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/clientes.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">Podras acceder a las ediciones comunes.</p>
                        <a href="" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ventas</h5>
                        <p class="card-text">Podras acceder a las ediciones comunes.</p>
                        <a href="../ventas" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Podras acceder a las ediciones comunes.</p>
                        <a href="../usuarios" class="btn btn-primary">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-img">
                    <img src="./img/img5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Notificaciones</h5>
                        <p class="card-text">Podras acceder a las ediciones comunes.</p>
                        <a href="../notificaciones" class="btn btn-primary mb-1">Ir a las opciones</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
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