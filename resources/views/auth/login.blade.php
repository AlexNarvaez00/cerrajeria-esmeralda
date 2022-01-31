@extends('rootview')


@section('header-seccion')

<x-header visible=faLse>
    <x-slot name="items">
    </x-slot>
</x-header>
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
  <form method="POST" action="{{ route('login') }}" class="col-lg-5 col-md-12 mt-5">
    @csrf
    <div class="componentes-formulario">
      <div class="d-flex justify-content-center">
          <img src="./img/usuario.png" class="medida-1">
      </div>
      <!--Inputs del propio formulario-->
      <div class="m-4">
        <label for="nombreUser" class="form-label">Correo/Nombre de usuario</label>
        <input type="email" name="email" class="form-control" id="nombreUser" aria-describedby="emailHelp" placeholder="">
        <!-- <div id="emailHelp" class="form-text">Ingrese el nombre de usuario</div> -->
        @error('email')
          <p class="col-12 text-danger ps-2"> {{$message}}</p>
        @enderror
      </div>
      <!--Inputs del propio formulario-->
      <div class="m-4">
        <label for="passwordUser" class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" id="passwordUser" aria-describedby="emailHelp" placeholder="">
        @error('password')
          <p class="col-12 text-danger ps-2"> {{$message}}</p>
        @enderror
        <!-- <div id="emailHelp" class="form-text">Ingrese la constraseña</div> -->
      </div>
      <!--Botones del formulario-->
      <div class="m-4 d-flex justify-content-end">
        <x-button-normal-form  type="reset" estiloBoton="btn-outline-danger" texto="Cancelar"/>
        <x-button-normal-form  type="submit" estiloBoton="btn-outline-success" texto="Iniciar"/>
      </div>
    </div>
  </form>
</div>

@endsection