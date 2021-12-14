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
    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, {{ $nombreUsuarioVista }}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#128101;</span>
        Clientes
    </h5>

    <div class="container-fluid mb-4">
        <form action="" class="row d-flex justify-content-end">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="ID del cliente que desea buscar">
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
                            <!--ID de la tabla usuarios-->    
                            <th scope="col">{{$cliente->idcliente}}</th>
                            <!--Los otros atributos de la tabla usuarios-->
                            <td>{{$cliente->nombre}}</td>
                            <td>{{$cliente->apellidoPaterno}}</td>
                            <td>{{$cliente->apellidoMaterno}}</td>
                            <td>{{$cliente->telefono}}</td>
                            <!--Botones-->
                                <td>
                                    <button class="btn" data-id-db="{{$fila->idcliente}}">
                                        <span>&#128394;</span>
                                    </button>
                                </td>
                            <td>
                            <form class="form-detele" action="{{route('clientes.destroy',$cliente)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete" data-bs-toggle="modal" data-bs-target="#confirmacionModal">
                                    <span>&#10060;</span>
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                <!--Columnas :v-->
                
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre del cliente</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreCliente" name="nombre">
                    </div>
                </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoPCliente" name="apellidoPaterno">
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1"id="inputApellidoMCliente" name="apellidoMaterno">
                    </div>
                </div>
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Número de teléfono</span>
                        <input type="text" class="form-control" placeholder="Ej. 9514628538" aria-label="Username" aria-describedby="basic-addon1" id="inputNumTelefono" name="telefono">
                    </div>
                </div>
        </div>
    @endslot
    @slot('footerModal')
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <button type="button" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Registrar
        </button>
    @endslot
    @endcomponent

    @component('components.modalSimple')
        @slot('idModal','confirmacionModal')
        @slot('tituloModal','¿Seguro que quieres borrar este registro?')
        @slot('cuerpoModal')

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
   
@endsection

