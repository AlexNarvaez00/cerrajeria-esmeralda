@extends('rootview')


@section('header-seccion')
  @component('components.header')
    <!--Items de la barra de menu-->
    @slot('items')
      <li class="nav-item">
        <a class="nav-link text-dark" href="/menu">Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="#">Acerca de...</a>
      </li>
    @endslot
    <!--Esta parte es para mostrar el boton de log out-->
    @slot('visible',false)
  @endcomponent
@endsection

<!--
  En esta parte, son los items de la barra de navegacion
  aun que los escribi fuera del componente, forman parte de el.

  **No se si hacer esto este bien pero fue lo unico que se ocurrio,
  la otra forma estaba muy perra :,,,,,v .
-->
@section('itemsmenu')

@endsection



<!--Seccion del contenido de la pagina donde te encuentres, este sigue siendo, lo mismo-->
@section('contenido')

<!-- <center><h1 class="text-aling-center"><svg xmlns="http://www.w3.org/2000/svg" width="57.84" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
</svg>Log in</h1></center> -->

<!--Formulario del login-->
<div class="row container-fluid d-flex justify-content-center">
  <!--Codigo del formulario-->
  <form action="" class="col-lg-5 col-md-12">
    <div class="componentes-formulario">
      <h1 class="h2 text-center mt-5">log In</h1>
      <!--Inputs del propio formulario-->
      <div class="m-4">
        <label for="nombreUser" class="form-label">Correo/Nombre de usuario</label>
        <input type="email" class="form-control" id="nombreUser" aria-describedby="emailHelp" placeholder="">
        <!-- <div id="emailHelp" class="form-text">Ingrese el nombre de usuario</div> -->
      </div>
      <!--Inputs del propio formulario-->
      <div class="m-4">
        <label for="passwordUser" class="form-label">Contraseña</label>
        <input type="email" class="form-control" id="passwordUser" aria-describedby="emailHelp" placeholder="">
        <!-- <div id="emailHelp" class="form-text">Ingrese la constraseña</div> -->
      </div>
      <!--Botones del formulario-->
      <div class="m-4 d-flex justify-content-end">
        <button type="submit" class="btn pl-3 pr-3 border-dark me-3">Iniciar</button>
        <button type="submit" class="btn pl-3 pr-3 border-dark">Cancelar</button>
      </div>
    </div>
  </form>
</div>

@endsection