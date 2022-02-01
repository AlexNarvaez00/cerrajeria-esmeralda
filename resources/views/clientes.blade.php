@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  <x-header visible=true>
    <x-slot name="items">
        <x-itemsNavBar active='clientes' />
        </x-slot>
</x-header>
@endsection

<!-----------------------------Títulos de la tabla e información del usuario en sesión----------------------------->
@section('contenido')

    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, {{ auth()->user()->name }}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#128101;</span>
        Clientes
    </h5>
<!------------------------------------- Cuerpo de la página ----------------------------------->
    <div class="container-fluid mb-4">
    <!--Botones principales de busqueda y agregar-->        
        <form method="GET" action="{{route('clientes.index')}}" class="row d-flex justify-content-end">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="Nombre del cliente que desea buscar" name="inputBusqueda">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                    <span class="me-3">&#128269</span>  
                    Buscar
                </button>
            </div>
                <div class="col-auto">
                <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroClienteModal">
                    <span class="me-3">&#10133;</span>
                    Agregar
                </button>
            </div>
        </form>
    </div>

<!-------------------------------------Seccion de la tabla---------------------------------->
    <div class="conteiner-fluid">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <!--
                        Campos de la tabla
                        -->
                        @foreach ($camposVista as $campo)
                            <th scope="col">{{$campo}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!--Aqui van los registros-->
                    @foreach($registrosVista as $cliente)
                        <!--Inicio de la Fila-->
                        <tr>
                            <!--ID de la tabla clientes-->    
                            <th scope="col">{{$cliente->idcliente}}</th>
                            <!--Los otros atributos de la tabla clientes-->
                            <td class="data">{{$cliente->nombre}}</td>
                            <td class="data">{{$cliente->apellidoPaterno}}</td>
                            <td class="data">{{$cliente->apellidoMaterno}}</td>
                            <td class="data">{{$cliente->telefono}}</td>
                            <!--Botones-->
                                <td>
                                <a class="btneditar" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                    <button class="btn boton-editar" 
                                        data-id="{{$cliente->idcliente}}"
                                        data-nombre="{{$cliente->nombre}}"
                                        data-apellidop="{{$cliente->apellidoPaterno}}"
                                        data-apellidom="{{$cliente->apellidoMaterno}}"
                                        data-tel="{{$cliente->telefono}}"
                                        data-bs-toggle="modal"
                                        data-route-url="{{route('clientes.update',$cliente)}}" 
                                        data-bs-target="#editarClientesModal">
                                        <span>&#128394;</span>
                                    </button>
                                </td>
                            <td>
                            <a class="btnborrar" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar">
                            <form class="form-detele" action="{{route('clientes.destroy',$cliente)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="btn delete" 
                                    data-id="{{$cliente->idcliente}}"
                                    data-nombre="{{$cliente->nombre}}"
                                    data-apellidop="{{$cliente->apellidoPaterno}}"
                                    data-apellidom="{{$cliente->apellidoMaterno}}"
                                    data-tel="{{$cliente->telefono}}"

                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmacionModal">
                                    <span>&#10060;</span>
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$registrosVista->links()}}
        </div>
    </div>

    <!----------------------------------Modal de registro de un cliente------------------------------->

    <x-modal idModal="registroClienteModal" tituloModal="Modulo para registrar un cliente" 
    rutaEnvio="{{route('clientes.store')}}" metodoFormulario="POST">
    <x-slot name="cuerpoModal">
        <p class="px-3">
            Formulario para registrar un cliente
        </p>

        <x-tag-obligatorios />

        <div class="container-fluid">
            <div class="row">
                @csrf
                
                <!--Input oculto para el IDE del cliente-->
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDCliente" name="idcliente">
                <x-input-normal expresion="Error, valor no admitido. Ejemplo: Alexis (Debe iniciar en mayúsculas)" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNombreCliente" type="text" texto="Nombre del Cliente" valor="{{old('nombre')}}" nombreInput="nombre" nombreError="nombre" onKeypress="return sololetras(event)" />           
                </div>
                <div class="row">
                <!--Columnas :v-->
                <x-input-normal expresion="Error, valor no admitido. Ejemplo: Ruiz (Debe iniciar en mayúsculas)" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoPCliente" type="text" texto="Apellido Paterno" valor="{{old('apellidoPaterno')}}" nombreInput="apellidoPaterno" nombreError="apellidoPaterno" onKeypress="return sololetras(event)"/>
                <x-input-normal expresion="Error, valor no admitido. Ejemplo: Pérez (Debe iniciar en mayúsculas)" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoMCliente" type="text" texto="Apellido Materno" valor="{{old('apellidoMaterno')}}" nombreInput="apellidoMaterno" nombreError="apellidoMaterno" onKeypress="return sololetras(event)" />
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNumTelefono" type="number" texto="Número de Teléfono" valor="{{old('telefono')}}" placeholder="Ej. 9514628538" nombreInput="telefono" nombreError="telefono" />
                </div>
           
        </div>
        </x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Registrar" />

    <!--
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Registrar
        </button>
    -->
    </x-slot>
</x-modal>

<!----------------------------------Modal de confirmación de un cliente------------------------------->
<x-modalSimple idModal="confirmacionModal" tituloModal="¿Seguro que quieres borrar este registro?">
    <x-slot name="cuerpoModal"></x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Confirmar" id="botonModalConfirmacion" />
    </x-slot>
</x-modalSimple>

<!----------------------------------Modal de edición de un cliente------------------------------->

<x-modal idModal="editarClientesModal" tituloModal="Editar un cliente." 
rutaEnvio="" metodoFormulario="POST">
    <x-slot name="cuerpoModal">
        <p class="px-3">
            Formulario para editar un cliente
        </p>

        <x-tag-obligatorios />

        <div class="container-fluid">
            <div class="row">
                @csrf
                
                <input type="hidden" name="urlTemp" value="{{old('urlTemp')}}" id="urlTemp">
                @method('PUT')
                <!--Checar método PUT-->
                <!--Input oculto para el IDE del cliente-->
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDCliente" name="idcliente">
                <x-input-normal expresion="Error, valor no admitido. Ejemplo: Alexis (Debe iniciar en mayúsculas)" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNombreClienteEditar" type="text" texto="Nombre del Cliente" valor="{{old('nombreEditar')}}" nombreInput="nombreEditar" nombreError="nombreEditar" onKeypress="return sololetras(event)"/>
                </div>
                <div class="row">
                <!--Columnas :v-->
                <x-input-normal expresion="Error, valor no admitido. Ejemplo: Ruiz (Debe iniciar en mayúsculas)" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoPClienteEditar" type="text" texto="Apellido Paterno" valor="{{old('apellidoPaternoEditar')}}" nombreInput="apellidoPaternoEditar" nombreError="apellidoPaternoEditar" onKeypress="return sololetras(event)"/>
                <x-input-normal expresion="Error, valor no admitido. Ejemplo: Pérez (Debe iniciar en mayúsculas)" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoMClienteEditar" type="text" texto="Apellido Materno" valor="{{old('apellidoMaternoEditar')}}" nombreInput="apellidoMaternoEditar" nombreError="apellidoMaternoEditar" onKeypress="return sololetras(event)"/>
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNumTelefonoEditar" type="number" texto="Número de Teléfono" valor="{{old('telefonoEditar')}}" placeholder="Ej. 9514628538" nombreInput="telefonoEditar" nombreError="telefonoEditar" />
                </div>
        </div>
        </x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Guardar" />
    </x-slot>
</x-modal>

<!---------------------------------------------------Modal ADVERTENCIA------------------------------------------------->
@if('noValido')
        <div class="modal" tabindex="-1" id="negacionModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registro no admitido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="alert alert-danger" role="alert">
                    @error('noValido')
                        {{$message}}.
                    @enderror
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">¡OK!</button>
            </div>
            </div>
        </div>
        </div>
@endif

@endsection



<!--En esta seccion van los scripts para cada una de las vistas-->
@section('scritps')
    <script src="./js/validaciones/clientes.js"></script>
    <script src="./js/modales/ModalConfirmClien.js"></script>
    <script src="./js/funciones/editarCliente.js"></script>
    <script src="./js/modales/Vnumeros.js"></script>
    


    @if($errors->hasAny('nombre', 'apellidoPaterno','apellidoMaterno', 'telefono'))
        <script>
            let modalRegistro = new bootstrap.Modal(document.getElementById('registroClienteModal'),null);
            modalRegistro.show();
        </script>
    @endif

    @if($errors->hasAny('nombreEditar', 'apellidoPaternoEditar', 'apellidoMaternoEditar', 'telefonoEditar'))
        <script>
            let modalEdicion = new bootstrap.Modal(document.getElementById('editarClientesModal'),null);
            modalEdicion.show();
        </script>
    @endif

    @if($errors->has('noValido'))
        <script>
            let modalEdicion = new bootstrap.Modal(document.getElementById('negacionModal'),null);
            modalEdicion.show();
        </script>    
    @endif

@endsection
