@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        @component('components.itemsNavBar')
            @slot('active','proveedores')
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
        <span>&#128666;</span>
        Proveedores
    </h5>

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
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreProveedor" name="nombre">
                    </div>
                </div>    
            </div>
            <div class="row">
            <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoPProveedor" name="apellidopaterno">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoMProveedor" name="apellidomaterno">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Número de Teléfono</span>
                        <input type="text" class="form-control" placeholder="Ej. 9513302424" aria-label="Username" aria-describedby="basic-addon1" id="inputNumTelefono" name="numtelefono">
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Correo Electrónico</span>
                        <input type="email" class="form-control" placeholder="CHAPAS@hotmail.com" aria-label="Username" aria-describedby="basic-addon1" id="inputCorreo" name="correo">
                    </div>
                </div>
            </div> 
            <p class="px-3">
            Dirección
            </p>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text" id="basic-addon1">Calle</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputCalle" name="calle">
                    </div>
                </div>
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Número ext</span>
                    <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNumExt" name="numext">
                </div>
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputEstado">Estado</label>
                            <select id="inputEstado" class="form-select" name="estados" value="">
                                <option selected value="0">Selecciona un estado</option>
                                @foreach($registroEstados as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}} </option>                    
                                @endforeach
                            </select>
                </div>
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idMunicipio">Municipio</label>
                    <select id="idMunicipio" class="form-select" name="municipios">
                        <option selected value="0">Selecciona un municipio</option>               
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idColonia">Colonia</label>
                    <select id="idColonia" class="form-select" name="colonias">
                        <option selected value="0">Selecciona una colonia</option>
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

    <!--########################### Modal de confirmación para eliminar al proveedor ################################# -->

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

<!--########################### Modal para editar la información del proveedor ###################################### -->

@component('components.modal')
    @slot('idModal','editarProveedorModal')
    @slot('tituloModal','Editar un proveedor.')
    @slot('rutaEnvio','')
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
                @method('PUT')
                <input type="hidden" class="" placeholder="" aria-label="" aria-describedby="" id="inputIDProveedorEditar" name="idProveedor">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreProveedorEditar" name="nombreEditar">
                    </div>
                </div>    
            </div>
            <div class="row">
            <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoPProveedorEditar" name="apellidopaterno">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoMProveedorEditar" name="apellidomaterno">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Número de Teléfono</span>
                        <input type="text" class="form-control" placeholder="Ej. 9513302424" aria-label="Username" aria-describedby="basic-addon1" id="inputNumTelefonoEditar" name="numtelefono">
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Correo Electrónico</span>
                        <input type="email" class="form-control" placeholder="CHAPAS@hotmail.com" aria-label="Username" aria-describedby="basic-addon1" id="inputCorreoEditar" name="correo">
                    </div>
                </div>
            </div> 
            <p class="px-3">
            Dirección
            </p>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 col-md-12 col-sm-12">
                        <span class="input-group-text" id="basic-addon1">Calle</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputCalleEditar" name="calle">
                    </div>
                </div>
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Número ext</span>
                    <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNumExtEditar" name="numext">
                </div>
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputEstadoEditar">Estado</label>
                            <select id="inputEstadoEditar" class="form-select" name="estados" value="">
                                <option selected value="0">Selecciona un estado</option>
                                @foreach($registroEstados as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}} </option>                    
                                @endforeach
                            </select>
                </div>
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idMunicipioEditar">Municipio</label>
                    <select id="idMunicipioEditar" class="form-select" name="municipios">
                        <option selected value="0">Selecciona un municipio</option>               
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3">
                <label class="input-group-text" for="idColoniaEditar">Colonia</label>
                    <select id="idColoniaEditar" class="form-select" name="colonias">
                        <option selected value="0">Selecciona una colonia</option>
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


<!--En esta seccion van los scripts para cada una de las vistas-->
@section('scritps')
    <!--
        En esta parte, van los scripts, pero van en una carpeta aparte,
        esa carpeta la iba a crear Omar, el chiste es que no se escriba Codigo de 
        Javascript con el de PHP, sino que se coloque en otro archivo y que lo cargue al
        ultimo. 
    -->
    
    <script src="./js/validaciones/proveedores.js"></script>
        
        
        <script >
            //Ayudame san pedro
        const formulariosBorrar = document.getElementsByClassName('form-detele');
        let cuerpoModalInformacion = document.querySelector('#confirmacionModal .modal-body')
        let FORMULARIO_GLOBAL = null;

        for (let index = 0; index < formulariosBorrar.length; index++) {
            const formulario = formulariosBorrar[index];
            //Agregamos el vento de submit a cada "formulario" de las filas 
            //en los registros de la tabla
            formulario.addEventListener('submit',(event)=>{
                event.preventDefault();//Evitamos que el formulario envie cosas.
                const filaHTML = event
                                    .target
                                    .parentNode
                                    .parentNode;
                const registros = filaHTML.getElementsByClassName('data');
               
                //Colocar la informacion en el modal.
                for (let index = 0; index < registros.length; index++) {
                    //registros[index];
                    const filaBooststrap = document.createElement("div");
                    filaBooststrap.classList.add('row');//Agregamos la clase de booststrap

                    const columnaCampo = document.createElement("div");
                    columnaCampo.classList.add('col-6');
                    columnaCampo.innerText = 'CampoNombre:'

                    const columnaInformacion = document.createElement("div");
                    columnaInformacion.classList.add('col-6');
                    columnaInformacion.innerText = registros[index].innerHTML;
                    
                    filaBooststrap.appendChild(columnaCampo);
                    filaBooststrap.appendChild(columnaInformacion);
                    
                    cuerpoModalInformacion.appendChild(filaBooststrap);
                }
                FORMULARIO_GLOBAL = event.target;
                //console.log(cuerpoModalInformacion);
            });


        }

        let botonModalConfirmacion = document.getElementById('botonModalConfirmacion');
        botonModalConfirmacion.addEventListener('click',event=>{
            console.log(FORMULARIO_GLOBAL);
            FORMULARIO_GLOBAL.submit();
            FORMULARIO_GLOBAL = null;
        });
    </script>


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
<script src="./js/funciones/editarProveedor.js"></script>


@endsection