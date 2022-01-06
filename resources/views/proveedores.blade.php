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
                            <td class="data">{{$proveedor->correo}}</td>
                            <td class="data">{{$proveedor->iddirecproveedor}}</td> 
                            <!--Botones-->
                            <td>
                            <button class="btn boton-editar" 
                                data-id="{{$proveedor->idproveedor}}"
                                data-nombre="{{$proveedor->nombre}}"
                                data-apellidoP="{{$proveedor->apellidopaterno}}"
                                data-apellidoM="{{$proveedor->apellidomaterno}}"
                                data-correo="{{$proveedor->correo}}"
                                data-direccion="{{$proveedor->iddirecproveedor}}"
                                data-route-url="{{route('proveedores.update',$proveedor)}}"


                                data-bs-toggle="modal" 
                                data-bs-target="#editarProveedorModal">
                                <span>&#128394;</span>
                            </button>
                        </td>
                        <td>
                            <form class="form-detele" action="{{route('proveedores.destroy',$proveedor)}}" method="POST">
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
            {{$registrosVista->links()}}
        </div>
    </div>

            <!--########################### Modal Formulario para agregar a un nuevo proveedor  ############################## -->
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
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                @csrf
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDProveedor" name="idProveedor">
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNombreProveedor" type="text" texto="Nombre del Proveedor" valor="{{old('nombre')}}" nombreInput="nombre" nombreError="nombre" />
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoPProveedor" type="text" texto="Apellido Paterno" valor="{{old('apellidopaterno')}}" nombreInput="apellidopaterno" nombreError="apellidopaterno" />
            </div>
            <div class="row">
            <!--Columnas :v-->
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoMProveedor" type="text" texto="Apellido Materno" valor="{{old('apellidomaterno')}}" nombreInput="apellidomaterno" nombreError="apellidomaterno" />
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNumTelefono" type="number" texto="Número de Teléfono" valor="{{old('numtelefono')}}" nombreInput="numtelefono" nombreError="numtelefono" />
            </div>
            <div class="row">
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputCorreo" type="email" texto="Correo Electrónico" valor="{{old('correo')}}" nombreInput="correo" nombreError="correo" />
            </div> 
            <p class="px-3">
            Dirección
            </p>
            <div class="row">
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputCalle" type="text" texto="Calle" valor="{{old('calle')}}" nombreInput="calle" nombreError="calle" />
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNumExt" type="number" texto="Número Exterior" valor="{{old('numext')}}" nombreInput="numext" nombreError="numext" />
            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputEstado">Estado</label>
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
                        <label class="input-group-text" for="idMunicipio">Municipio</label>
                            <select id="idMunicipio" class="form-select {{ (old('municipios'))? 'is-valid':'' }}" name="municipios" value="{{old('municipios')}}">
                                <option selected value="0">Selecciona un municipio</option>               
                            </select>
                            @error('municipios')
                                <p class="col-12">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idColonia">Colonia</label>
                    <select id="idColonia" class="form-select {{ (old('colonias'))? 'is-valid':'' }}" name="colonias" value="{{old('colonias')}}">
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
    
    <!-- Botones anteriores
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Registrar
        </button>
    -->
    @endslot
    @endcomponent

    <!--########################### Modal de confirmación para eliminar al proveedor ################################# -->

    <x-modalSimple idModal="confirmacionModal" tituloModal="¿Seguro que quieres borrar este registro?">
    <x-slot name="cuerpoModal"></x-slot>
    <x-slot name="footerModal">
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
        <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Confirmar" id="botonModalConfirmacion" />
    </x-slot>
</x-modalSimple>


<!--########################### Modal para editar la información del proveedor ###################################### -->

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
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                @csrf
                <input type="hidden" name="urlTemp" value="{{old('urlTemp')}}" id="urlTemp">
                @method('PUT')
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDProveedorEditar" name="idProveedor">
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNombreProveedorEditar" type="text" texto="Nombre del Proveedor" valor="{{old('nombreEditar')}}" nombreInput="nombreEditar" nombreError="nombreEditar" />
                <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoPProveedorEditar" type="text" texto="Apellido Paterno" valor="{{old('apellidopaternoEditar')}}" nombreInput="apellidopaternoEditar" nombreError="apellidopaternoEditar" /> 
            </div>
            <div class="row">
            <!--Columnas :v-->
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputApellidoMProveedorEditar" type="text" texto="Apellido Materno" valor="{{old('apellidomaternoEditar')}}" nombreInput="apellidomaternoEditar" nombreError="apellidomaternoEditar" />
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNumTelefonoEditar" type="number" texto="Número de Teléfono" valor="{{old('numtelefonoEditar')}}" nombreInput="numtelefonoEditar" nombreError="numtelefonoEditar" />
            </div>
            <div class="row">
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputCorreoEditar" type="email" texto="Correo Electrónico" valor="{{old('correoEditar')}}" nombreInput="correoEditar" nombreError="correoEditar"/>
            </div> 
            <p class="px-3">
            Dirección
            </p>
            <div class="row">
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputCalleEditar" type="text" texto="Calle" valor="{{old('calleEditar')}}" nombreInput="calleEditar" nombreError="calleEditar"/>
            <x-input-normal class="col-md-12 col-sm-12" classesLabel="col-3" idInput="inputNumExtEditar" type="number" texto="Número Exterior" valor="{{old('numextEditar')}}" nombreInput="numextEditar" nombreError="numextEditar"/>
            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputEstadoEditar">Estado</label>
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
                        <label class="input-group-text" for="idMunicipioEditar">Municipio</label>
                            <select id="idMunicipioEditar" class="form-select" name="municipiosEditar" value="{{old('municipiosEditar')}}">
                                <option selected value="0">Selecciona un municipio</option>               
                            </select>
                            @error('municipiosEditar')
                                <p class="col-12">{{$message}}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idColoniaEditar">Colonia</label>
                    <select id="idColoniaEditar" class="form-select" name="coloniasEditar" value="{{old('coloniasEditar')}}">
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
    <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Registrar" />


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
<script >
        
        const selectorEstado = document.getElementById('inputEstado');
        const selectorMunicipio = document.getElementById('idMunicipio');
        const selectorColonia = document.getElementById('idColonia');
        const selectorEstadoEditar = document.getElementById('inputEstadoEditar');
        const selectorMunicipioEditar = document.getElementById('idMunicipioEditar');
        const selectorColoniaEditar = document.getElementById('idColoniaEditar');

function recuperarMunicipios(idSelector)
{
    let valor = event.target.value;
            //Este input, es el input oculto de la linea 116
            //let _token = $('');
            
            if(valor != '0'){

               minAjax({
                url:"{{route('estados.todo')}}", 
                type:"POST",
                data:{
                        _token: document.querySelector('input[name="_token"]').value,
                        id:valor
                },
                //Esta funcion se ejecuta cuando el servisor nos responde con los datos que enviamos
                success: function(data){
                    data = JSON.parse(data);
                    
                    let selectorMunicipio = document.getElementById(idSelector);
                    
                    let textoSelectorOP1 = document.createElement('option');
                    textoSelectorOP1.innerHTML = "-- Selecciona un municipio --";
                    textoSelectorOP1.value = 0;

                    let opcionesSeleccion = [textoSelectorOP1];

                    for (let index = 0; index < data.length; index++) {
                        let opcion =  document.createElement('option');
                        opcion.innerHTML = data[index].nombre;                       
                        opcion.value = data[index].idmunicipio;

                        opcionesSeleccion.push(opcion);                      
                    }

                    selectorMunicipio.innerHTML = '';

                    for (let idx = 0; idx < opcionesSeleccion.length; idx++) {
                            selectorMunicipio.appendChild(opcionesSeleccion[idx]);                    
                    }

                }
               });
            }
}

function recuperarColonias(idSelector)
{
    let valor = event.target.value;
            //Este input, es el input oculto de la linea 116
            //let _token = $('');
            
            if(valor != '0'){
               minAjax({
                url:"{{route('municipios.todo')}}", 
                type:"POST",
                data:{
                        _token: document.querySelector('input[name="_token"]').value,
                        idmunicipio:valor
                },
                //Esta funcion se ejecuta cuando el servisor nos responde con los datos que enviamos
                    success: function(data){
                    data = JSON.parse(data);

                    let selectorColonia = document.getElementById(idSelector);
                    
                    let textoSelectorOP1 = document.createElement('option');
                    textoSelectorOP1.innerHTML = "-- Selecciona una colonia --";
                    textoSelectorOP1.value = 0;

                    let opcionesSeleccion = [textoSelectorOP1];

                    for (let index = 0; index < data.length; index++) {
                        let opcion =  document.createElement('option');
                        opcion.innerHTML = data[index].nombre;                       
                        opcion.value = data[index].idcolonia;

                        opcionesSeleccion.push(opcion);                      
                    }

                    selectorColonia.innerHTML = '';

                    for (let idx = 0; idx < opcionesSeleccion.length; idx++) {
                            selectorColonia.appendChild(opcionesSeleccion[idx]);                    
                    }

                }
               });
              
            }
}
        selectorEstado.addEventListener("change",(event)=>{
            recuperarMunicipios('idMunicipio');
        });

        selectorMunicipio.addEventListener("change",(event)=>{
           recuperarColonias('idColonia');
        });

        selectorEstadoEditar.addEventListener("change",(event)=>{
            recuperarMunicipios('idMunicipioEditar');
        });

        selectorMunicipioEditar.addEventListener("change",(event)=>{
           recuperarColonias('idColoniaEditar');
        });
</script>

@if($errors->hasAny('nombre', 'apellidopaterno', 'apellidomaterno',
'numtelefono', 'correo', 'calle', 'numext', 'estados', 'municipios', 'colonias'))
        <script>
            let modalRegistro = new bootstrap.Modal(document.getElementById('registroProveedorModal'),null);
            modalRegistro.show();
            let formulario = modal.getElementsByTagName('form')[0];
            formulario.action = document.getElementById('urlTemp').value;
        </script>
    @endif

    @if($errors->hasAny('nombreEditar', 'apellidopaternoEditar', 'apellidomaternoEditar', 'numtelefonoEditar', 'correoEditar', 
    'calleEditar', 'numextEditar', 'estadosEditar', 'municipiosEditar', 'coloniasEditar'))
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