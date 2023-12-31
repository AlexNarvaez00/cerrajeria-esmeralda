@extends('rootview')
<!--
---- Rama de omar tiene pedos 
-->
<!--Contenido del header.-->
@section('header-seccion')
<x-header visible=true>
    <x-slot name="items">
        <x-itemsNavBar active="usuarios" />
    </x-slot>
</x-header>
<!--Esta es la prte del boton de log out -->
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
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->rol}}</td>
                    <td>{{$usuario->created_at}}</td>
                    <td>{{$usuario->updated_at}}</td>

                    <!--Botones-->
                    <td>
                        <button class="btn boton-editar" data-id="{{$usuario->id}}" data-nombre="{{$usuario->name}}" data-correo="{{$usuario->email}}" data-rol="{{$usuario->rol}}" data-route-url="{{route('usuarios.update',$usuario)}}" data-bs-toggle="modal" data-bs-target="#editarUsuariosModal">
                            <span data-bs-toggle="tooltip" data-bs-placement="right" title="Editar"> &#128394;</span>
                        </button>
                    </td>
                    <td>
                        @if ($usuario->rol != 'Administrador' )
                        <form class="form-detele" action="{{route('usuarios.destroy',$usuario)}}" method="POST">
                            <!-- route productos-venta "store"-->
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete" data-id="{{$usuario->id}}" data-nombre="{{$usuario->name}}" data-rol="{{$usuario->rol}}" data-creado="{{$usuario->created_at}}" data-modificado="{{$usuario->updated_at}}" data-bs-toggle="modal" data-bs-target="#confirmacionModal">
                                <span data-bs-toggle="tooltip" data-bs-placement="right" title="Borrar">&#10060;</span>
                            </button>
                        </form>
                        @else
                        <a href="#" class="btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Accion no permitida">
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
<x-modal idModal="registroUsuariosModal" tituloModal="Registrar un nuevo usuario." rutaEnvio="{{route('usuarios.store')}}" metodoFormulario="POST">
    <x-slot name="cuerpoModal">
        <p class="px-3">
            Informacion básica del usuario.
        </p>
        @error('id')
        <p class="col-12 text-danger ps-2"> {{$message}} ó existen datos duplicados</p>
        @enderror

        <x-tag-obligatorios />

        <div class="container-fluid">
            <!--Directiva,  sirve como seguridad .v jajajajaj-->
            @csrf
            <!--Input oculto para el IDE del usuario-->
            <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDUsuario" name="idUsuario">
            <!--Columnas :v-->
            <div class="row">
                <x-input-normal expresion="Error, valor no admitido, Ejemplo: Oscar" class="col-md-12 col-sm-12 col-10" classesLabel="col-lg-3 col-md-12 col-sm-12 col-12" idInput="inputNombreUsuario" type="text" texto="Nombre de Usuario" valor="{{old('nombreUsuario')}}" nombreInput="nombreUsuario" nombreError="nombreUsuario" />
            </div>
            <div class="row">
                <x-input-normal expresion="Correo electronio no valido, Ejemplo sis@gmail.com" class="col-md-12 col-sm-12 col-10" classesLabel="col-lg-3 col-md-12 col-sm-12 col-12" idInput="inputCorreo" type="email" texto="Correo" valor="{{old('correo')}}" nombreInput="correo" nombreError="correo" />
            </div>
            <div class="row">
                <x-input-normal expresion="Error, valor no admitido, Cantidad minima de letras es 8, con mayusculas, minusculas y numeros" class="col-md-12 col-sm-12 col-10" classesLabel="col-lg-3 col-md-12 col-sm-12 col-12" idInput="inputPasswordUsuario" type="password" texto="Contraseña" nombreInput="contrasena" nombreError="contrasena"/>
            </div>
            <div class="row">
                <x-input-normal class="col-md-12 col-sm-12 col-10" classesLabel="col-lg-3 col-md-12 col-sm-12 col-12" idInput="inputPasswordUsuarioCon" type="password" texto="Confirmar Contraseña" nombreInput="contrasena_confirmation" nombreError="contrsenaConfirmada" />
            </div>
        </div>
        <p class="px-3">
            Rol del usuario.
        </p>
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                <div class="input-group mb-3">
                    <label class="input-group-text col-lg-3 col-md-12 col-sm-12 col-12" for="inputRolUsuario">
                        Roles
                        <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                    </label>
                    <select class="form-select {{ (old('rolUser'))? 'is-valid':'' }}" id="inputRolUsuario" name="rolUser" value="{{old('rolUser')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccione un valor">>
                        <option selected value="0">Selecciones rol de Usuario</option>
                        @foreach ($listaRoles as $rol)
                        <option value="{{$rol}}">{{$rol}}</option>
                        @endforeach
                    </select>
                    @error('rolUser')
                    <p class="col-12 text-danger ps-2"> {{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Registrar" />

        <!-- <button type="reset" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
    <span class="me-2">&#10060;</span>
    Cancelar
</button> -->

        <!-- <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
    <span class="me-2">&#10004;</span>
    Registrar
</button> -->
    </x-slot>
</x-modal>

<!-- ####################################### Modal de confirmacion de un Usuario ####################################### -->
<x-modalSimple idModal="confirmacionModal" tituloModal="¿Seguro que quieres borrar este registro?">
    <x-slot name="cuerpoModal"></x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Confirmar" id="botonModalConfirmacion" />
    </x-slot>
</x-modalSimple>
<!-- ####################################### Modal de edicion de un Usuario ####################################### -->
<x-modal idModal="editarUsuariosModal" tituloModal="Editar un usuario." rutaEnvio="" metodoFormulario="POST">
    <x-slot name="cuerpoModal">
        <p class="px-3">
            Informacion básica del usuario.
        </p>

        <x-tag-obligatorios />

        <div class="container-fluid">
            <!--Directiva, basicmanete -->
            @csrf
            @method('PUT')
            <input type="hidden" name="urlTemp" value="{{old('urlTemp')}}" id="urlTemp">

            <div class="row">
                <!--Columnas :v-->
                <x-input-normal expresion="Error, valor no admitido, Ejemplo: Oscar" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNombreUsuarioEditar" type="text" texto="Nombre de Usuario" valor="{{old('nombreUsuarioEditar')}}" nombreInput="nombreUsuarioEditar" nombreError="nombreUsuarioEditar" />
            </div>
            <div class="row">
                <x-input-normal expresion="Correo electronio no valido, Ejemplo sis@gmail.com" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputCorreoEditar" type="email" texto="Correo" valor="{{old('correoEditar')}}" nombreInput="correoEditar" nombreError="correoEditar" />
            </div>
            <div class="row">
                <x-input-normal expresion="Error, valor no admitido, Cantidad minima de letras es 8, con mayusculas, minusculas y numeros" class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputPasswordUsuarioEditar" type="password" texto="Contraseña" nombreInput="contrasenaEditar" nombreError="contrasenaEditar" />
            </div>
            <div class="row">
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputPasswordUsuarioConEditar" type="password" texto="Confirmar Contraseña" valor="{{old('contrsenaConfirmadaEditar')}}" nombreInput="contrasenaEditar_confirmation" nombreError="contrsenaConfirmadaEditar" />
            </div>
        </div>
        <p class="px-3">
            Rol del usuario.
        </p>
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                <div class="input-group mb-3 selector-obligatorio">
                    <label class="input-group-text" for="inputRolUsuarioEditar">
                        Roles
                        <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                    </label>
                    <select class="form-select" id="inputRolUsuarioEditar" name="rolUserEditar" value="{{old('rolUserEditar')}}">
                        <option selected value="0">Selecciones rol de Usuario</option>
                        @foreach ($listaRoles as $rol)
                        <option value="{{$rol}}">{{$rol}}</option>
                        @endforeach
                    </select>
                    @error('rolUserEditar')
                    <p class="col-12 text-danger ps-2"> {{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Guardar" />
    </x-slot>
</x-modal>

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
                <x-button-normal-form type="reset" estiloBoton="btn-outline-primary" texto="!OK¡" data-bs-dismiss="modal" />
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
@if($errors->hasAny('nombreUsuario', 'correo','contrasena', 'rolUser'))
<script>
    let modalRegistro = new bootstrap.Modal(document.getElementById('registroUsuariosModal'), null);
    modalRegistro.show();

    let formulario = modal.getElementsByTagName('form')[0];
    formulario.action = document.getElementById('urlTemp').value;
</script>
@endif

@if($errors->hasAny('nombreUsuarioEditar','correoEditar', 'contrasenaEditar', 'rolUserEditar'))
<script>
    let modalEdicion = new bootstrap.Modal(document.getElementById('editarUsuariosModal'), null);
    modalEdicion.show();

    let formulario = modal.getElementsByTagName('form')[0];
    formulario.action = document.getElementById('urlTemp').value;
</script>
@endif

@if($errors->has('noValido'))
<script>
    let modalEdicion = new bootstrap.Modal(document.getElementById('negacionModal'), null);
    modalEdicion.show();

    let formulario = modal.getElementsByTagName('form')[0];
    formulario.action = document.getElementById('urlTemp').value;
</script>
@endif

@endsection