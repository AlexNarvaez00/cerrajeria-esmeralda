@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
<x-header visible=true>
  <x-slot name="items">
    <x-itemsNavBar active='notificaciones' />
  </x-slot>
</x-header>
@endsection

@section('contenido')
<!-- Elementos que muestran la información de la persona previamente al Log In -->
<h5 class="h5 text-star mt-5 ps-3">
  <span>&#128075;</span>
  ¡Hola, {{ auth()->user()->name }}!
</h5>
<h5 class="h5 text-star mt-3 mb-5 ps-3">
  <span>&#128276;</span>
  Notificaciones
  <span id="cantidad"></span>
</h5>


<!-- Genera las alertas/notificaciones para la vista de notificaciones-->
<div class="conteiner mt-3 d-flex justify-content-center">
  <div class="toast-container row mb-3 flex-column ">
    @foreach($productosEscasos as $notificaciones)
    <x-toast tituloNotificacion="{{$notificaciones['titulo']}}" tiempo="" nombreProducto="{{$notificaciones['producto']->nombre_producto}}" producto="{{$notificaciones['producto']->clave_producto}}" conclusion="{{$notificaciones['conclusion']}}">
    </x-toast>
    @endforeach

  </div>
</div>
@endsection
@section('scritps')
<script src="./js/minAjax.js"></script>
<script>
  minAjax({
    url: "{{route('productos.notificacionesTotal')}}", //request URL
    type: "GET", //Request type GET/POST
    //Send Data in form of GET/POST
    data: {},
    //CALLBACK FUNCTION with RESPONSE as argument
    success: function(data) {
      data = JSON.parse(data);
      document.getElementById('cantidad').innerHTML = '' + data.cantidad;

      //Esto ira en la vista raiz
      if(data.cantidad != 0){
        let btnNotificaciones = document.getElementById('btnNoificaciones');
        btnNotificaciones.classList.add('text-danger');
        document.querySelector('#btnNoificaciones .icon').classList.add("icon_notify")
      }
    }

  });
</script>
@endsection