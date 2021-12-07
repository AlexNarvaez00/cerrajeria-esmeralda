@extends('rootview')

@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        @component('components.itemsNavBar')
            @slot('active','notificaciones')
        @endcomponent
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
<h5 class="h5 text-star mt-3 mb-5 ps-3">
    <span>&#128276;</span>
    Notificaciones
</h5>


<!-- Genera las alertas/notificaciones para la vista de notificaciones-->
<div class="conteiner mt-3 d-flex justify-content-center">
  <div class="toast-container row mb-3 flex-column ">
    @component('components.toast')
      @slot('tituloNotificacion','titulo 01')
      @slot('tiempo','hace 11 minutos')
      @slot('descripcion')
        <strong>Producto:</strong>
         esta por temrinarse
      @endslot
    @endcomponent

    @component('components.toast')
      @slot('tituloNotificacion','titulo 01')
      @slot('tiempo','hace 11 minutos')
      @slot('descripcion')
        <strong>Producto:</strong>
         esta por temrinarse
      @endslot
    @endcomponent

    @component('components.toast')
      @slot('tituloNotificacion','titulo 01')
      @slot('tiempo','hace 11 minutos')
      @slot('descripcion')
        <strong>Producto:</strong>
         esta por temrinarse
      @endslot
    @endcomponent

    @component('components.toast')
      @slot('tituloNotificacion','titulo 01')
      @slot('tiempo','hace 11 minutos')
      @slot('descripcion')
        <strong>Producto:</strong>
         esta por temrinarse
      @endslot
    @endcomponent

    @component('components.toast')
      @slot('tituloNotificacion','titulo 01')
      @slot('tiempo','hace 11 minutos')
      @slot('descripcion')
        <strong>Producto:</strong>
         esta por temrinarse
      @endslot
    @endcomponent

  </div>
</div>
@endsection