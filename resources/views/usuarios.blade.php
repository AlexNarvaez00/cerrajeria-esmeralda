@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
<!--Esta es la prte del boton de log out -->
@component('components.header')
@slot('items')
    @component('components.itemsNavBar')
        @slot('active','usuarios')
    @endcomponent
@endslot

<!--Esta parte es para mostrar el boton de log out-->
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
    Usuarios
</h5>

<div class="container-fluid mb-4">
    <!--Experimental-->
    <form method="GET" action="{{route('usuarios.index')}}" class="row d-flex justify-content-end">
        <div class="col-5">
            <input type="text" class="form-control" placeholder="burcar ID" name="inputBusqueda">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                <span class="me-3">&#128269</span>
                Buscar
            </button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroUsuariosModal">
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
                        Estos lo pienso mandar desde el controlador
                    -->
                    @foreach ($camposVista as $campo)
                        <th scope="col">{{$campo}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!--Aqui van los registros-->
                @foreach($registrosVista as $usuario)
                    <!--Inicio de la Fila-->
                    <tr>
                        <!--ID de la tabla usuarios-->    
                        <th class="data" scope="col">{{$usuario->idusuario}}</th>
                        <!--Los otros atributos de la tabla usuarios-->
                        <td class="data">{{$usuario->nombreUsuario}}</td>
                        <td class="data">{{$usuario->rol}}</td>
                        <td class="data">{{$usuario->created_at}}</td>
                        <td class="data">{{$usuario->updated_at}}</td>

                        <!--Botones-->
                        <td>
                            <button class="btn" data-id-db="{{$usuario->idusuario}}">
                                <span>&#128394;</span>
                            </button>
                        </td>
                        <td>
                            <form class="form-detele" action="{{route('usuarios.destroy',$usuario)}}" method="POST"> <!-- route productos-venta "store"-->
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
        @slot('idModal','registroUsuariosModal')
        @slot('tituloModal','Registrar un nuevo usuario.')
        
        /**Agregar estas dos cosas a sus modales*/
            @slot('rutaEnvio',route('usuarios.store'))
            @slot('metodoFormulario','POST')
        /**Fin de los nuevo */
        
        @slot('cuerpoModal')
            <p class="px-3">
                Informacion básica del usuario.
            </p>
            <div class="container-fluid">
                <div class="row">
                    <!--Directiva, basicmanete sirve como seguridad .v jajajajaj-->
                    @csrf
                    <!--Columnas :v-->
                    <div class="col-md-12 col-sm-12">
                        <div class="input-group mb-3 ">
                            <span class="input-group-text col-3" id="basic-addon1">Id de Usuario</span>
                            <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputIDUsuario" name="idUsuario">
                        </div>
                    </div>
                    <!--Columnas :v-->
                    <div class="col-md-12 col-sm-12">
                        <div class="input-group mb-3 ">
                            <span class="input-group-text col-3" id="basic-addon1">Nombre de Usuario</span>
                            <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreUsuario" name="nombreUsuario">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Contraseña</span>
                        <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuario" name="contrasena">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Confirmar Contraseña</span>
                        <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuarioCon" name="contrsenaConfirmada">
                    </div>
                </div> 
            </div>
            <p class="px-3">
                Rol del usuario.
            </p>
            <div class="container-fluid">
                <div class="row">
                    <!--Columnas :v-->
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputRolUsuario">Roles</label>
                        <select class="form-select" id="inputRolUsuario" name="rolUser" value="">
                                <option selected>Selecciones rol de Usuario</option>
                            @foreach ($listaRoles as $rol)
                                <option value="{{$rol}}">{{$rol}}</option>
                            @endforeach
                        </select>
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

<!--En esta seccion van los scripts para cada una de las vistas-->
@section('scritps')
    <script src="./js/validaciones/usuarios.js"></script>
    <script src="./js/modales/mostrarModalConfirmUsuarios.js"></script>
@endsection
