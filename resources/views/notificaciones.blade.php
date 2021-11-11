@extends('rootview')

@section('itemsmenu')
<!--Items de la barra del menu-->
<!-- nav para la barra de navegación --> 
<nav class="navbar navbar-expand-lg navbar-light bg-white">
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
  <a class="nav-link text-dark" href="#">Usuarios</a>
</li>
<li class="nav-item">
  <a class="nav-link text-dark" href="#">Notificaciones</a>
</li>
<button type="submit" class="btn pl-3 pr-3 border-dark me-3 button-end"href="#">Log Out</button>
</nav>
@endsection

@section('contenido')
<!-- Elementos que muestran la información de la persona previamente al Log In -->
    <h2 class="h2 text-start mt-2">Hola  PERSONA X</h2>
<!-- Genera las alertas/notificaciones para la vista de notificaciones-->
<div class="conteiner">
  <h2 class="h2 text-start mt-2 mb-4 ">Notificaciones</h2>

    <!-- Inicio de la notificación centrada -->
    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-lg-5">
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <h4 class="alert-heading">Producto con ID:#######</h4>
            <p>El número de productos en almacen se encuentra en límite de llegar a la cantidad permitida</p>
            <hr>
              <p class="mb-0">Puedes solicitar productos yendo a proveedores</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
    <!-- Fin de la notificación centrada -->

    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-lg-5">
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <h4 class="alert-heading">Producto con ID:#######</h4>
            <p>El número de productos en almacen se encuentra en límite de llegar a la cantidad permitida</p>
            <hr>
              <p class="mb-0">Puedes solicitar productos yendo a proveedores</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
    
      <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-lg-5">
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <h4 class="alert-heading">Producto con ID:#######</h4>
            <p>El número de productos en almacen se encuentra en límite de llegar a la cantidad permitida</p>
            <hr>
              <p class="mb-0">Puedes solicitar productos yendo a proveedores</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-lg-5">
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <h4 class="alert-heading">Producto con ID:#######</h4>
            <p>El número de productos en almacen se encuentra en límite de llegar a la cantidad permitida</p>
            <hr>
              <p class="mb-0">Puedes solicitar productos yendo a proveedores</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-lg-5">
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <h4 class="alert-heading">Producto con ID:#######</h4>
            <p>El número de productos en almacen se encuentra en límite de llegar a la cantidad permitida</p>
            <hr>
              <p class="mb-0">Puedes solicitar productos yendo a proveedores</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>


</div>
@endsection