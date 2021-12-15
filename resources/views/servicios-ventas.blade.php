@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        @component('components.itemsNavBar')
            @slot('active','ventas')
        @endcomponent
    @endslot
  
    <!--Esta parte es para mostrar el boton de log out-->
    @slot('visible',true)
  @endcomponent
@endsection


@section('contenido')
<!--Encabezado bienvenida-->
<h5 class="h5 text-star mt-5 ps-3">
  <span>&#128075;</span>   
    ¡Hola, XXXX XXXX XXXX!
</h5>
<!--Titulo modulo-->
<h5 class="h5 text-star mt-3 mb-5 ps-3 ">
  <span>&#129520;</span> Venta de servicios  
</h5>
<div class="container-fluid mb-4">
        <form action="" class="row d-flex justify-content-end">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="Buscar servicio" name="inputBusqueda">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                    <span class="me-3">&#128269</span>  
                    Buscar
                </button>
            </div>
                <div class="col-auto">
                <button type="button" onclick = "limpiar()" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroServicioModal">
                    <span class="me-3">&#10133;</span>
                    Agregar
                </button>
            </div>
        </form>
    </div>
    @component('components.modal')
    @slot('idModal','registroServicioModal')
    @slot('tituloModal','Registrar un nuevo producto')
    @slot('rutaEnvio',route('productos.store'))
    @slot('metodoFormulario','POST')
    @slot('cuerpoModal')    
   
       
    @endslot
    @slot('footerModal')
       
    @endslot
    @endcomponent
@endsection
@section('scritps')
    
@endsection