@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  <x-header visible=true>
    <x-slot name="items">
        <x-itemsNavBar active='proveedores' />
    </x-slot>
</x-header>
@endsection

<!--########################### Titulos de la tabla. -- Info del Usuario en sesión ################################# -->
@section('contenido')
    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, {{ auth()->user()->name }}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#128666;</span>
        Proveedores
    </h5>
<!--########################### Cuerpo de la página ################################# -->

    <div class="container-fluid mb-4">
    <form method="GET" action="{{route('proveedores.index')}}" class="row d-flex justify-content-end">
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
                <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroProveedorModal">
                    <span class="me-3">&#10133;</span>
                    Agregar
                </button>
            </div>
        </form>
    </div>

    <!--########################### Sección de la tabla ################################# -->
    <div class="conteiner-fluid">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <!--
                            Campos de la tabla 
                            Estos lo pienso mandar desde el controlador
                        -->
                        @foreach ($camposTabla as $campo)
                            <th scope="col">{{$campo}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!--Aqui van los registros-->
                    @foreach($registrosVista as $proveedor)
                        <!--Inicio de la Fila-->
                        <tr>
                            <!--ID de la tabla Proveedor-->    
                            <th scope="col">{{$proveedor->idproveedor}}</th>
                            <!--Los otros atributos de la tabla proveedor-->
                            <td class="data">{{$proveedor->nombre}}</td>
                            <td class="data">{{$proveedor->apellidopaterno}}</td>
                            <td class="data">{{$proveedor->apellidomaterno}}</td>
                            <td class="data">{{$proveedor->telefono}}</td>
                            <td class="data">{{$proveedor->correo}}</td>
                            <td class="data">{{$proveedor->iddirecproveedor}}</td> 
                            <!--Botones-->
                            <td>
                            <a class="btneditar" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                            <button class="btn boton-editar" 
                                data-id="{{$proveedor->idproveedor}}"
                                data-nombre="{{$proveedor->nombre}}"
                                data-apellidoP="{{$proveedor->apellidopaterno}}"
                                data-apellidoM="{{$proveedor->apellidomaterno}}"
                                data-numtelefono="{{$proveedor->telefono}}"
                                data-correo="{{$proveedor->correo}}"
                                data-direccion="{{$proveedor->iddirecproveedor}}"
                                data-route-url="{{route('proveedores.update',$proveedor)}}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editarProveedorModal">
                                <span>&#128394;</span>
                            </button>
                        </td>
                        <td>
                        @if(auth()->user()->rol == "Administrador")
                        <a class="btnborrar" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar">
                            <form class="form-detele" action="{{route('proveedores.destroy',$proveedor)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete" 
                                data-id="{{$proveedor->idproveedor}}"
                                data-nombre="{{$proveedor->nombre}}"
                                data-apellidoP="{{$proveedor->apellidopaterno}}"
                                data-apellidoM="{{$proveedor->apellidomaterno}}"
                                data-numtelefono="{{$proveedor->telefono}}"
                                data-correo="{{$proveedor->correo}}"
                                data-direccion="{{$proveedor->iddirecproveedor}}"
                                data-bs-toggle="modal" data-bs-target="#confirmacionModal">
                                    <span>&#10060;</span>
                                </button>
                            </form>
                            @elseif
                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Accion no permitida">
                                <span>&#x2753;</span>
                            </button>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$registrosVista->links()}}
        </div>
    </div>
            <!--########################### Modal Formulario para agregar a un nuevo proveedor  ############################## -->
    <!-- 
        | Modal utilizado como formulario para agregar a un nuevo proveedor, la información 
        | es mandada oculta por el método POST.
        | Las entradas (imputs) del modal son evaluados para su correcta introducción de la información
        | así mismo, sus entradas son obligatorias, lanza un texto mencionando las entradas obligatorias.
    -->
    @component('components.modal')
    @slot('idModal','registroProveedorModal')
    @slot('tituloModal','Módulo de Proveedor.')
    @slot('rutaEnvio',route('proveedores.store'))
    @slot('metodoFormulario','POST')

    @slot('cuerpoModal')
        <p class="px-3">
            Formulario para registrar a un nuevo proveedor.
        </p>
        <p class="px-3">
            Información del Proveedor
        </p>
        <x-tag-obligatorios />
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                @csrf
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDProveedor" name="idProveedor">
                <x-input-normal expresion="Valor no admitido, Ejemplo: Oscar David" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNombreProveedor" type="text" texto="Nombre(s) del Proveedor" valor="{{old('nombre')}}" nombreInput="nombre" nombreError="nombre" />
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputApellidoPProveedor" type="text" texto="Apellido Paterno" valor="{{old('apellidopaterno')}}" nombreInput="apellidopaterno" nombreError="apellidopaterno" />
            </div>
            <div class="row">
            <!--Columnas :v-->
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputApellidoMProveedor" type="text" texto="Apellido Materno" valor="{{old('apellidomaterno')}}" nombreInput="apellidomaterno" nombreError="apellidomaterno" />
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNumTelefono" type="number" texto="Número de Teléfono" valor="{{old('numtelefono')}}" nombreInput="numtelefono" nombreError="numtelefono" />
            </div>
            <div class="row">
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputCorreo" type="email" texto="Correo Electrónico" valor="{{old('correo')}}" nombreInput="correo" nombreError="correo" />
            </div> 
            <p class="px-3">
            Dirección
            </p>
            <div class="row">
            <x-input-normal expresion="Valor no admitido, Ejemplo: Av. Benito Juarez" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputCalle" type="text" texto="Calle" valor="{{old('calle')}}" nombreInput="calle" nombreError="calle" />
            <x-input-normal expresion="Valor no admitido, Ejemplo: 122 o 122-B" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNumExt" type="text" texto="Número Exterior" valor="{{old('numext')}}" nombreInput="numext" nombreError="numext" />
            <x-input-normal expresion="Valor no admitido, Ejemplo: 004 o 004-C" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNumInt" type="text" texto="Número Interior" valor="{{old('numint')}}" nombreInput="numint" nombreError="numint" />
            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputEstado">
                            Estado
                        <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                        </label>
                            <select id="inputEstado" class="form-select {{ (old('estados'))? 'is-valid':'' }}" name="estados" value="{{old('estados')}}">
                                <option selected value="0">Selecciona un estado</option>
                                @foreach($registroEstados as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}} </option>                    
                                @endforeach
                            </select>
                            @error('estados')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div> 
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="idMunicipio">
                            Municipio
                            <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                        </label>
                            <select id="idMunicipio" class="form-select {{ (old('municipios'))? 'is-valid':'' }}" disabled="true" name="municipios" value="{{old('municipios')}}">
                                <option selected value="0">Selecciona un municipio</option>               
                            </select>
                            @error('municipios')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idColonia">
                    Colonia
                    <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                </label>
                    <select id="idColonia" class="form-select {{ (old('colonias'))? 'is-valid':'' }}" disabled="true" name="colonias" value="{{old('colonias')}}">
                        <option selected value="0">Selecciona una colonia</option>
                    </select>
                    @error('colonias')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                </div>
            </div>
        </div>
    @endslot
    @slot('footerModal')
    <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
    <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Registrar" />
    @endslot
    @endcomponent

    <!--########################### Modal de confirmación para eliminar al proveedor ################################# -->

    <x-modalSimple idModal="confirmacionModal" tituloModal="¿Seguro que quieres borrar este registro?">
    <x-slot name="cuerpoModal"></x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Confirmar" id="botonModalConfirmacion" />
    </x-slot>
</x-modalSimple>

<!--########################### Modal para editar la información del proveedor ###################################### -->
    <!-- 
        | Modal utilizado como formulario para editar (actualizar) la información del proveedor seleccionado, la información 
        | es mandada oculta por el método POST.
        | Las entradas (imputs) del modal son evaluados para su correcta introducción de la información
        | así mismo, sus entradas son obligatorias, lanza un texto mencionando las entradas obligatorias.
    -->
@component('components.modal')
    @slot('idModal','editarProveedorModal')
    @slot('tituloModal','Editar un proveedor.')
    @slot('rutaEnvio','')
    @slot('metodoFormulario','POST')

    @slot('cuerpoModal')
        <p class="px-3">
            Formulario para editar a un proveedor
        </p>
        <p class="px-3">
            Información del Proveedor
        </p>
        <x-tag-obligatorios />
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                @csrf
                <input type="hidden" name="urlTemp" value="{{old('urlTemp')}}" id="urlTemp">
                @method('PUT')
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDProveedorEditar" name="idProveedor">
                <x-input-normal expresion="Valor no admitido, Ejemplo: Oscar David" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNombreProveedorEditar" type="text" texto="Nombre(s) del Proveedor" valor="{{old('nombreEditar')}}" nombreInput="nombreEditar" nombreError="nombreEditar" />
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputApellidoPProveedorEditar" type="text" texto="Apellido Paterno" valor="{{old('apellidopaternoEditar')}}" nombreInput="apellidopaternoEditar" nombreError="apellidopaternoEditar" /> 
            </div>
            <div class="row">
            <!--Columnas :v-->
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputApellidoMProveedorEditar" type="text" texto="Apellido Materno" valor="{{old('apellidomaternoEditar')}}" nombreInput="apellidomaternoEditar" nombreError="apellidomaternoEditar" />
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNumTelefonoEditar" type="number" texto="Número de Teléfono" valor="{{old('numtelefonoEditar')}}" nombreInput="numtelefonoEditar" nombreError="numtelefonoEditar" />
            </div>
            <div class="row">
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputCorreoEditar" type="email" texto="Correo Electrónico" valor="{{old('correoEditar')}}" nombreInput="correoEditar" nombreError="correoEditar"/>
            </div> 
            <p class="px-3">
            Dirección
            </p>
            <div class="row">
            <x-input-normal expresion="Valor no admitido, Ejemplo: Av. Benito Juarez" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputCalleEditar" type="text" texto="Calle" valor="{{old('calleEditar')}}" nombreInput="calleEditar" nombreError="calleEditar"/>
            <x-input-normal expresion="Valor no admitido, Ejemplo: 122 o 122-B" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNumExtEditar" type="text" texto="Número Exterior" valor="{{old('numextEditar')}}" nombreInput="numextEditar" nombreError="numextEditar"/>
            <x-input-normal expresion="Valor no admitido, Ejemplo: 004 o 004-C" class="col-md-12 col-sm-12" classesLabel="col-4" idInput="inputNumIntEditar" type="text" texto="Número Interior" valor="{{old('numintEditar')}}" nombreInput="numintEditar" nombreError="numintEditar"/>
            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputEstadoEditar">
                            Estado
                            <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                        </label>
                            <select id="inputEstadoEditar" class="form-select" name="estadosEditar" value="{{old('estadosEditar')}}">
                                <option selected value="0">Selecciona un estado</option>
                                @foreach($registroEstados as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}} </option>                    
                                @endforeach
                            </select>
                            @error('estadosEditar')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div> 
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="idMunicipioEditar">
                            Municipio
                            <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                        </label>
                            <select id="idMunicipioEditar" class="form-select" disabled="true" name="municipiosEditar" value="{{old('municipiosEditar')}}">
                                <option selected value="0">Selecciona un municipio</option>               
                            </select>
                            @error('municipiosEditar')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idColoniaEditar">
                    Colonia
                <span class="text-danger ms-1 fs-5 fw-bold">*</span>
                </label>
                    <select id="idColoniaEditar" class="form-select" disabled="true" name="coloniasEditar" value="{{old('coloniasEditar')}}">
                        <option selected value="0">Selecciona una colonia</option>
                    </select>
                    @error('coloniasEditar')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                </div>
            </div>
        </div>
    @endslot
    @slot('footerModal')
    <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
    <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Registrar" />
    @endslot
    @endcomponent

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
    <!--
        En esta parte, van los scripts, pero van en una carpeta aparte,
        esa carpeta la iba a crear Omar, el chiste es que no se escriba Codigo de 
        Javascript con el de PHP, sino que se coloque en otro archivo y que lo cargue al
        ultimo. 
    -->
    <script src="./js/validaciones/proveedores.js"></script>
    <script src="./js/funciones/editarProveedor.js"></script>    
    <script src="./js/modales/mostrarModalConfirmProveedores.js"></script>
    <!--CDN :v o algo asi la neta ni me acuerdo xd-->
    <!-- https://flouthoc.github.io/minAjax.js/ -->
    <!--Pero esta madre se necesita para hacer AJAX mas simple -->
<script type="text/javascript" src="./js/minAjax.js"></script>
    <!-- script para los selectores de los municipios y colonias -->
<script src="./js/funciones/cargarselectoresProv.js"></script>

@if($errors->hasAny('nombre', 'apellidopaterno', 'apellidomaterno',
'numtelefono', 'correo', 'calle', 'numext','numint', 'estados', 'municipios', 'colonias'))
        <script>
            let modalRegistro = new bootstrap.Modal(document.getElementById('registroProveedorModal'),null);
            modalRegistro.show();
            let formulario = modal.getElementsByTagName('form')[0];
            formulario.action = document.getElementById('urlTemp').value;
        </script>
    @endif

    @if($errors->hasAny('nombreEditar', 'apellidopaternoEditar', 'apellidomaternoEditar', 'numtelefonoEditar', 'correoEditar', 
    'calleEditar', 'numextEditar','numintEditar', 'estadosEditar', 'municipiosEditar', 'coloniasEditar'))
        <script>
            let modalEdicion = new bootstrap.Modal(document.getElementById('editarProveedorModal'),null);
            modalEdicion.show();
            let formulario = modal.getElementsByTagName('form')[0];
            formulario.action = document.getElementById('urlTemp').value;
        </script>
    @endif

    @if($errors->has('noValido'))
        <script>
            let modalEdicion = new bootstrap.Modal(document.getElementById('negacionModal'),null);
            modalEdicion.show();
            let formulario = modal.getElementsByTagName('form')[0];
            formulario.action = document.getElementById('urlTemp').value;
        </script>    
    @endif

@endsection