@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        @component('components.itemsNavBar')
            @slot('active','clientes')
        @endcomponent
@endslot

@slot('visible',true)
@endcomponent
@endsection


@section('contenido')


<!--seccion titulo-->
    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, {{ auth()->user()->name }}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#128101;</span>
        Clientes
    </h5>
<!--cuerpo página-->
    <div class="container-fluid mb-4">
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

<!--Seccion de la tabla-->
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
                            <!--Los otros atributos de la tabla usuarios-->
                            <td>{{$cliente->nombre}}</td>
                            <td>{{$cliente->apellidoPaterno}}</td>
                            <td>{{$cliente->apellidoMaterno}}</td>
                            <td>{{$cliente->telefono}}</td>
                            <!--Botones-->
                                <td>
                                    <button class="btn boton-editar" 
                                        data-id="{{$cliente->idcliente}}"
                                        data-nombre="{{$cliente->nombre}}"
                                        data-nombre="{{$cliente->apellidoPaterno}}"
                                        data-nombre="{{$cliente->apellidoMaterno}}"
                                        data-nombre="{{$cliente->telefono}}"
                                        data-bs-toggle="modal"
                                        data-route-url="{{route('clientes.update',$cliente)}}" 
                                        data-bs-target="#editarClientesModal">
                                        <span>&#128394;</span>
                                    </button>
                                </td>
                            <td>
                            <form class="form-detele" action="{{route('clientes.destroy',$cliente)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="btn delete" 
                                    data-id="{{$cliente->idcliente}}"
                                    data-nombre="{{$cliente->nombre}}"
                                    data-nombre="{{$cliente->apellidoPaterno}}"
                                    data-nombre="{{$cliente->apellidoMaterno}}"
                                    data-nombre="{{$cliente->telefono}}"

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
    @component('components.modal')
    @slot('idModal','registroClienteModal')
    @slot('tituloModal','Modulo para registrar un cliente')
    @slot('rutaEnvio',route('clientes.store'))
    @slot('metodoFormulario','POST')

    @slot('cuerpoModal')
        <p class="px-3">
            Formulario para registrar un cliente
        </p>
        <div class="container-fluid">
            <div class="row">
                @csrf
                
                <!--Input oculto para el IDE del cliente-->
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDCliente" name="idcliente">
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre del cliente</span>
                        <input type="text" class="form-control {{ ( old('nombre')!='' )? 'is-valid':'' }}" value="{{old('nombre')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreCliente" name="nombre">
                            @error('nombre')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                        </div>
                </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                    <input type="text" class="form-control {{ ( old('apellidoPaterno')!='' )? 'is-valid':'' }}" value="{{old('apellidoPaterno')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoPCliente" name="apellidoPaterno">
                            @error('apellidoPaterno')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                        </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                        <input type="text" class="form-control {{ ( old('apellidoMaterno')!='' )? 'is-valid':'' }}" value="{{old('apellidoMaterno')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoMCliente" name="apellidoMaterno">
                            @error('apellidoMaterno')
                                <p class="col-12">{{$message}}</p>
                            @enderror 
                    </div>
                </div>
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Número de teléfono</span>
                        <input type="number" class="form-control {{ ( old('telefono')!='' )? 'is-valid':'' }}" value="{{old('telefono')}}" placeholder="Ej. 9514628538" aria-label="Username" aria-describedby="basic-addon1" id="inputNumTelefono" name="telefono">
                            @error('telefono')
                                <p class="col-12">{{$message}}</p>
                            @enderror 
                    </div>
                </div>
        </div>
        @endslot
    @slot('footerModal')
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Registrar
        </button>
    @endslot
    @endcomponent

<!-- ####################################### Modal de confirmacion de un Cliente ####################################### -->

@component('components.modalSimple')
        @slot('idModal','confirmacionModal')
        @slot('tituloModal','¿Seguro que quieres borrar este registro?')
        @slot('cuerpoModal')
            <!-- Cuerpo del modal-->
            <p>¿Esta segunro que quiere borrar este registro?</p>
        @endslot
        @slot('footerModal')
            <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
                <span class="me-2">&#10060;</span>
                Cancelar
            </button>
            <button type="submit" class="btn btn-light d-flex ps-3 pe-3" id="botonModalConfirmacion">
                <span class="me-2">&#10004;</span>
                Confirmar
            </button>
        @endslot
    @endcomponent
   <!-- ####################################### Modal de edicion de un cliente ####################################### -->
    
   @component('components.modal')
        @slot('idModal','editarClientesModal')
        @slot('tituloModal','Editar un cliente.')
        @slot('rutaEnvio','')
        @slot('metodoFormulario','POST')

        @slot('cuerpoModal')
        <p class="px-3">
            Formulario para registrar un cliente
        </p>
        <div class="container-fluid">
            <div class="row">
                @csrf
                @method('PUT')
                <!--Checar método PUT-->
                
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre del cliente</span>
                        <input type="text" class="form-control {{ ( old('nombreEditar')!='' )? 'is-valid':'' }}" value="{{old('nombreEditar')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreClienteEditar" name="nombreEditar">
                            @error('nombreEditar')
                                <p class="col-12">{{$message}}</p>
                            @enderror                    
                        </div>
                </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                        <input type="text" class="form-control {{ ( old('apellidoPaternoEditar')!='' )? 'is-valid':'' }}" value="{{old('apellidoPaternoEditar')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoPClienteEditar" name="apellidoPaternoEditar">
                            @error('apellidoPaternoEditar')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                        </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                        <input type="text" class="form-control {{ ( old('apellidoMaternoEditar')!='' )? 'is-valid':'' }}" value="{{old('apellidoMaternoEditar')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoMClienteEditar" name="apellidoMaternoEditar">
                            @error('apellidoMaternoEditar')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                        </div>
                </div>
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Número de teléfono</span>
                        <input type="number" class="form-control {{ ( old('telefonoEditar')!='' )? 'is-valid':'' }}" value="{{old('telefonoEditar')}}" placeholder="Ej. 9514628538" aria-label="Username" aria-describedby="basic-addon1" id="inputNumTelefonoEditar" name="telefonoEditar">
                            @error('telefonoEditar')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                    </div>
                </div>
        </div>
        @endslot
        @slot('footerModal')
            <button type="reset" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
                <span class="me-2">&#10060;</span>
                Cancelar
            </button>
            <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                <span class="me-2">&#10004;</span>
                Registrar
            </button>
        @endslot
    @endcomponent

<!--Modal ADVERTENCIA -->
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
    


    <script src="./js/modales/clientesConfirmacion.js"></script>

@endsection
