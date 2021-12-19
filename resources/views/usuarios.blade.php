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

<!--################################ Ttiulos d ela ventana ##############################################-->
<h5 class="h5 text-star mt-5 ps-3">
    <span>&#128075;</span>
    ¡Hola, {{ auth()->user()->name }}!
</h5>
<h5 class="h5 text-star mt-3 mb-5 ps-3 ">
    <span>&#128101;</span>
    Usuarios
</h5>

<!-- #################################### Cuerpo de la pagina #################################### -->
<div class="container-fluid mb-4">
    <!--Botones principales de busqueda y agregar-->
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

<!--#################################### Seccion de la tabla #################################### -->
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
                        <th scope="col">{{$usuario->id}}</th>
                        <!--Los otros atributos de la tabla usuarios-->
                        <td >{{$usuario->name}}</td>
                        <td >{{$usuario->rol}}</td>
                        <td >{{$usuario->created_at}}</td>
                        <td >{{$usuario->updated_at}}</td>

                        <!--Botones-->
                        <td>
                            
                            <button class="btn boton-editar" 
                                data-id="{{$usuario->id}}"
                                data-nombre="{{$usuario->name}}"
                                data-correo="{{$usuario->email}}"
                                data-rol="{{$usuario->rol}}"
                                data-route-url="{{route('usuarios.update',$usuario)}}"

                                data-bs-toggle="modal" 
                                data-bs-target="#editarUsuariosModal">
                                <span>&#128394;</span>
                            </button>
                        </td>
                        <td>
                            @if ($usuario->rol != 'Administrador' )
                                <form class="form-detele" action="{{route('usuarios.destroy',$usuario)}}" method="POST"> <!-- route productos-venta "store"-->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="btn delete" 
                                        data-id="{{$usuario->id}}"
                                        data-nombre="{{$usuario->name}}"
                                        data-rol="{{$usuario->rol}}"
                                        data-creado="{{$usuario->created_at}}"
                                        data-modificado="{{$usuario->updated_at}}"

                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmacionModal">
                                        <span>&#10060;</span>
                                    </button>
                                </form>
                            @else
                                <a href="#" class="btn">
                                    <span>&#10060;</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$registrosVista->links()}}
    </div>
</div>

<!-- ####################################### Modal de registro de un Usuario ####################################### -->

    @component('components.modal')
        @slot('idModal','registroUsuariosModal')
        @slot('tituloModal','Registrar un nuevo usuario.')
        @slot('rutaEnvio',route('usuarios.store'))
        @slot('metodoFormulario','POST')
        
        @slot('cuerpoModal')
            <p class="px-3">
                Informacion básica del usuario.
            </p>
            <div class="container-fluid">
                <div class="row">
                    <!--Directiva, basicmanete sirve como seguridad .v jajajajaj-->
                    @csrf
                    <!--Input oculto para el IDE del usuario-->
                    <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDUsuario" name="idUsuario">
                    <!--Columnas :v-->
                    <div class="col-md-12 col-sm-12">
                        <div class="input-group mb-3 ">
                            <span class="input-group-text col-3" id="basic-addon1">Nombre de Usuario</span>
                            <input type="text" class="form-control {{ ( old('nombreUsuario')!='' )? 'is-valid':'' }}" value="{{old('nombreUsuario')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreUsuario" name="nombreUsuario">
                            @error('nombreUsuario')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Correo</span>
                        <input type="email" class="form-control" value="{{old('correo')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputCorreo" name="correo">
                        @error('correo')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Contraseña</span>
                        <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuario" name="contrasena">
                        @error('contrasena')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Confirmar Contraseña</span>
                        <input type="password" class="form-control"  placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuarioCon" name="contrasena_confirmation">
                        @error('contrsenaConfirmada')
                                <p class="col-12">{{$message}}</p>
                        @enderror
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
                        <select class="form-select {{ (old('rolUser'))? 'is-valid':'' }}" id="inputRolUsuario" name="rolUser" value = "{{old('rolUser')}}">
                                <option selected value="0">Selecciones rol de Usuario</option>
                            @foreach ($listaRoles as $rol)
                                <option value="{{$rol}}">{{$rol}}</option>
                            @endforeach
                        </select>
                        @error('rolUser')
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

<!-- ####################################### Modal de confirmacion de un Usuario ####################################### -->

    @component('components.modalSimple')
        @slot('idModal','confirmacionModal')
        @slot('tituloModal','¿Seguro que quieres borrar este registro?')
        @slot('cuerpoModal')
            <!-- Cuerpo del modal-->
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
    
<!-- ####################################### Modal de edicion de un Usuario ####################################### -->
@component('components.modal')
        @slot('idModal','editarUsuariosModal')
        @slot('tituloModal','Editar un usuario.')
        @slot('rutaEnvio','')
        @slot('metodoFormulario','POST')
        
        @slot('cuerpoModal')
            <p class="px-3">
                Informacion básica del usuario.
            </p>
            <div class="container-fluid">
                <div class="row">
                    <!--Directiva, basicmanete -->
                    @csrf
                    @method('PUT')
                    <!--Input oculto para el IDE del usuario-->
                    <!--Columnas :v-->
                    <div class="col-md-12 col-sm-12">
                        <div class="input-group mb-3 ">
                            <span class="input-group-text col-3" id="basic-addon1">Nombre de Usuario</span>
                            <input type="text" class="form-control" value="{{old('nombreUsuarioEditar')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreUsuarioEditar" name="nombreUsuarioEditar">
                            @error('nombreUsuarioEditar')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Correo</span>
                        <input type="email" class="form-control" value="{{old('correoEditar')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputCorreoEditar" name="correoEditar">
                        @error('correoEditar')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Contraseña</span>
                        <input type="password" class="form-control" value="{{old('contrasenaEditar')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuarioEditar" name="contrasenaEditar">
                        @error('contrasenaEditar')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text col-3" id="basic-addon1">Confirmar Contraseña</span>
                        <input type="password" class="form-control" value="{{old('contrsenaConfirmadaEditar')}}" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuarioConEditar" name="contrasenaEditar_confirmation">
                        @error('contrsenaConfirmadaEditar')
                                <p class="col-12">{{$message}}</p>
                        @enderror
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
                        <label class="input-group-text" for="inputRolUsuarioEditar">Roles</label>
                        <select class="form-select" id="inputRolUsuarioEditar" name="rolUserEditar" value="{{old('rolUserEditar')}}">
                                <option selected value="0">Selecciones rol de Usuario</option>
                            @foreach ($listaRoles as $rol)
                                <option value="{{$rol}}">{{$rol}}</option>
                            @endforeach
                        </select>
                        @error('rolUserEditar')
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


<!-- ####################################### Modal ADVERTENCIA ####################################### -->

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
    <script src="./js/validaciones/usuarios.js"></script>
    <script src="./js/modales/mostrarModalConfirmUsuarios.js"></script>
    <script src="./js/funciones/editarUsuario.js"></script>

    <!--CDN :v o algo asi la neta ni me acuerdo xd-->
    <!-- https://flouthoc.github.io/minAjax.js/ -->
    <!--Pero esta madre se necesita para hacer AJAX mas simple -->
    <!-- <script type="text/javascript" src="./js/minAjax.js"></script> -->
    <!--Este script se ejecuta si existe algun error en los datos-->
    @if($errors->hasAny('nombreUsuario', 'contrasena', 'rolUser'))
        <script>
            let modalRegistro = new bootstrap.Modal(document.getElementById('registroUsuariosModal'),null);
            modalRegistro.show();
        </script>
    @endif

    @if($errors->hasAny('nombreUsuarioEditar', 'contrasenaEditar', 'rolUserEditar'))
        <script>
            let modalEdicion = new bootstrap.Modal(document.getElementById('editarUsuariosModal'),null);
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
