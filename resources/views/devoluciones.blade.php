@extends('rootview')

@section('header-seccion')
  
  @component('components.header')
    @slot('items')
        @component('components.itemsNavBar')
            @slot('active','devoluciones')
        @endcomponent
@endslot

@slot('visible',true)
@endcomponent
@endsection


@section('contenido')

<div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre de producto</span>
                        <input id ="inNomProducto" maxlength="20" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="nombre_producto" required>
                    </div>
                </div>
            </div>

@endsection
