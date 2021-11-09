@extends('rootview')

@section('itemsmenu')
<!--Items de la barra del menu-->
<div class="m-4 d-flex justify-content-end">
        <button type="submit" class="btn pl-3 pr-3 border-dark me-3"href="#">Log Out</button>
</div>
@endsection

@section('contenido')
<!-- Elementos que muestran la información de la persona previamente al Log In -->
<div class="container d-flex justify-content-start">
    <h2 class="h2 text-start mt-2">Hola</h2>
</div>
<div class="container">
<h2 class="h2 text-center mt-2 mb-5">Ménu</h2>
    <div class="row">

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-text">
                    <div class="container">
                         <p class="pt-2 lead pinter">
                         <span class="label label-warning">Productos</span>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <h1 class="card-title h6">
                        <a class="text-decoration-none text-secondary" href="#">
                            <strong>Podras acceder a las ediciones comunes</strong>
                        </a>
                    </h1>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-text">
                    <div class="container">
                         <p class="pt-2 lead pinter">
                         <span class="label label-warning">Proveedores</span>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <h1 class="card-title h6">
                        <a class="text-decoration-none text-secondary" href="#">
                            <strong>Podras acceder a las ediciones comunes</strong>
                        </a>
                    </h1>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-text">
                    <div class="container">
                         <p class="pt-2 lead pinter">
                         <span class="label label-warning">Ventas</span>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <h1 class="card-title h6">
                        <a class="text-decoration-none text-secondary" href="#">
                            <strong>Podras acceder a las ediciones comunes</strong>
                        </a>
                    </h1>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-text">
                    <div class="container">
                         <p class="pt-2 lead pinter">
                         <span class="label label-warning">usuarios</span>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <h1 class="card-title h6">
                        <a class="text-decoration-none text-secondary" href="#">
                            <strong>Podras acceder a las ediciones comunes</strong>
                        </a>
                    </h1>
                </div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <article class="card h-100 shadow">
                <div class="card-text">
                    <div class="container">
                         <p class="pt-2 lead pinter">
                         <span class="label label-warning">Notificaciones</span>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <h1 class="card-title h6">
                        <a class="text-decoration-none text-secondary" href="#">
                            <strong>Podras acceder a las ediciones comunes</strong>
                        </a>
                    </h1>
                </div>
            </article>
        </div>


    </div>
</div>

@endsection