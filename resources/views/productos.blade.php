@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        @component('components.itemsNavBar')
            @slot('active','productos')
        @endcomponent
    @endslot
  
    <!--Esta parte es para mostrar el boton de log out-->
    @slot('visible',true)
  @endcomponent
@endsection


@section('contenido')
    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, {{ auth()->user()->name}}!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#128273;</span>
        Productos
    </h5>

    <div class="container-fluid mb-4">
        <form action="" class="row d-flex justify-content-end">
            <div class="col-5">
                <input id="inputBuscar" type="text" class="form-control" placeholder="Buscar producto" name="inputBusqueda">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                    <span class="me-3">&#128269</span>  
                    Buscar
                </button>
            </div>
                <div class="col-auto">
                <button type="button" onclick = "limpiar()" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroProductoModal">
                    <span class="me-3">&#10133;</span>
                    Agregar
                </button>
            </div>
        </form>
    </div>

    <!--Seccion de la tabla-->
    <div class="conteiner-fluid">
        <div class="col-12 text-center">
            <table class="table">
                <thead>
                    <tr>
                    @foreach ($camposVista as $campo)
                        <th scope="col">{{$campo}}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach($registrosProductos as $producto)
                    <!--Inicio de la Fila-->
                    <tr>
                        <!--ID de la tabla usuarios-->    
                        <th class="dato" scope="col">{{$producto->clave_producto}}</th>
                        <!--Los otros atributos de la tabla usuarios-->
                        <td class="dato">{{$producto->nombre_producto}}</td>
                        <td class="dato">{{$producto->clasificacion}}</td>
                        <td class="dato">&#36;{{$producto->precio_producto}}</td>
                        <td class="dato">&#36;{{$producto->precio_compra}}</td>
                        <td class="dato">{{$producto->cantidad_existencia}}</td>
                        <td class="dato">{{$producto->idproveedor}}</td>  
                        <td class="dato">{{$producto->cantidad_stock}}</td>                     
                        
                        <!--Botones-->
                        <td>
                            <a class="btnDetalles" data-bs-toggle="tooltip" data-bs-placement="top" title="ver detalles">
                                <button type = "button" class="btn" data-bs-toggle="modal" data-bs-target="#verdetalles" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver detalles">
                                    <span>&#128065;</span>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a class="btnEditar" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">                                
                                <button type = "button" class="btn" data-bs-toggle="modal" data-bs-target="#registroProductoModal">
                                    <span>&#128394;</span>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#confirmacionModal">
                                <span>&#10060;</span>
                            </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
    @component('components.modal')
    @slot('idModal','registroProductoModal')
    @slot('tituloModal','Registrar un nuevo producto')
    @slot('rutaEnvio',route('productos.store'))
    @slot('metodoFormulario','POST')
    @slot('cuerpoModal')       
        <div class="container-fluid">
            <p class="px-3">
                <h6 id="letreroInstruccion">Agregue la información sobre el producto</h6>
            </p>
            <div class="row">
            @csrf                
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1 ">
                        <span class="input-group-text" id="basic-addon1">Clave producto</span>                       
                        <input id ="inClaveProducto" maxlength="10" type="text" class="form-control" placeholder="Clave del producto" aria-label="Username" aria-describedby="basic-addon1" name="clave_producto" required>
                    </div>                    
                    <label class="text-danger" for="basic-url" id="labelCampoClave">*Campo obligatorio</label>  
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Nombre de producto</span>
                        <input id ="inNomProducto" maxlength="20" type="text" class="form-control" placeholder="Nombre del producto" aria-label="Username" aria-describedby="basic-addon1" name="nombre_producto" required>                        
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label> 
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Cant. existencia</span>
                        <input id ="inCantExistencia" type="number" class="form-control" min = "0" value="0" placeholder="Cantidad en existencia" aria-label="Username" aria-describedby="basic-addon1" name="cantidad_existencia" required>
    
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>                 
                </div> 
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Stock</span>
                        <input id ="inStock" min="0" type="number" class="form-control" placeholder="Stock" aria-label="Username" aria-describedby="basic-addon1" name="cantidad_stock">
                    </div>    
                    <label class="text-danger" for="basic-url">* Campo obligatorio</label>             
                </div> 
                
            </div>           
            <br>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Precio venta $</span>
                        <input id ="inPrecio" type="number" min="1" step="0.01" class="form-control" value="1.00" placeholder="Precio venta" aria-label="Username" aria-describedby="basic-addon1" name="precio_producto" required>
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>   
                </div> 
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Precio compra $</span>
                        <input id ="inPreciocompra" type="number" min="1" step="0.01" class="form-control" value="1.00" placeholder="Precio compra" aria-label="Username" aria-describedby="basic-addon1" name="precio_compra" required>
                    </div>   
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>                    
                </div>                
            </div>
            <br>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Clasificación</span>
                        <input id ="inClasificacion" maxlength="20" type="text" class="form-control" placeholder="Clasificación" aria-label="Username" aria-describedby="basic-addon1" name="clasificacion">
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div>
            </div>
            <br>
            <div class = "row">
                <div class="col-md-12 col-sm-12"> 
                    <div class="input-group">
                        <span class="input-group-text">Descripcion</span>
                        <textarea id="inDescripcion" class="form-control" aria-label="With textarea" placeholder="Puedes agregar la marca, el color, etc." name="descripcion" required></textarea>
                    </div> 
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div>
            </div>           
        </div>
        <hr>
        <div class="container-fluid">
            <p class="px-3">
                <h6 id="letreroInstruccion">Agregue la información el proveedor del producto</h6>
            </p>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="inputGroupSelect01">Proveedores</label>
                        <select class="form-select" id="proveedores" name="idproveedor">
                            <option value = "0" selected>Seleccione un proveedor</option>
                            @foreach($registrosProveedores as $proveedor)
                            <option value="{{$proveedor->idproveedor}}">{{$proveedor->idproveedor}} {{$proveedor->nombre}}</option>                    
                            @endforeach
                        </select>
                    </div>
                    <label class="text-danger" for="basic-url">*Seleccion obligatoria</label>
                </div>
                <div class="col-md-6 col-sm-6">
                    <button type="button" class="btn btn-link" data-bs-target="#agregarProveedor" data-bs-toggle="modal" data-bs-dismiss="modal">agregar proveedor</button>
                </div>
            </div>
        </div>
    @endslot
    @slot('footerModal')        
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />  
        <div id="btnRegistrarProducto" style="display:none">        
        <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Registrar" />
        </div>
        <div id="btnGuardarCambios" style="display:none">
        <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Guardar" data-bs-toggle="modal" data-bs-target="#confirmacionModificacion" data-bs-dismiss="modal"/>
        </div>
    @endslot
    @endcomponent


@component('components.modalSimple')
    @slot('idModal','verdetalles')
    @slot('tituloModal','Detalles del producto')
    @slot('cuerpoModal')
    <!--Información del producto-->
    <div class="container-fluid">  
        <h6> Información del producto </h6>             
        <div class="row">            
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Clave producto</span>
                    <input id="detalleClave" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>                    
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Nombre de producto</span>
                    <input id="detalleNombreProducto" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Precio compra</span>
                    <input id = "detallePrecioCompra" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Precio venta</span>
                    <input id="detallePrecio" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Cantidad en existencia</span>
                    <input id="detalleExistencia" disabled="true" type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">stock</span>
                    <input id = "detallestock" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Clasificación</span>
                    <input id = "detalleClasificacion" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="input-group">
                    <span class="input-group-text">Descripcion del producto</span>
                    <textarea id="detalleDescripcion" disabled="true" class="form-control" aria-label="With textarea" placeholder="Puedes agregar la marca, el color, etc." name="descripcion" required></textarea>
                </div>                
            </div>
        </div>
    </div>        
    <hr> 
    <!--Información del proveedor-->
    
        <div class="container-fluid"> 
            <h6>Información del proveedor<h6>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Id Proveedor</span>
                        <input id="detalleIdProveedor" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre proveedor</span>
                        <input id="detalleNombreProveedor" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">apellido paterno</span>
                        <input id="detalleApellidoP" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div> 
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">apellido materno</span>
                        <input id="detalleapellidoM" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">correo</span>
                        <input id="detalleCorreo" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>  
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">iddireccion</span>
                        <input id="detalledireccion" disabled="true" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>                           
                </div>  
            </div>
        </div>               
    @endslot
    @slot('footerModal')
    @csrf
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />        
    @endslot
    @endcomponent
    <!--Modal para agregar un nuevo Poovedor-->
    @component('components.modalSimple')
    @slot('idModal','agregarProveedor')
    @slot('tituloModal','Agregar Proveedor')
    @slot('cuerpoModal')
    <form id="formularioProveedor" method="POST">
        <div class="container-fluid">
            <p class="px-3">
                <h6>Información básica del proveedor</h6>
            </p>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Nombre</span>
                        <input id="txtNombreProveedor" maxlength="50" placeholder="Nombre del proveedor" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="txtNombreProveedor" required>                     
                    </div>   
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>                 
                </div>                
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                        <input id="txtApellidoPProveedor" maxlength="50" placeholder="Apellido paterno del proveedor" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="txtApellidoPProveedor" required>
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div> 
            </div>      
            <br>      
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                        <input id="txtApellidoMProveedor" maxlength="50" placeholder="Apellido materno del proveedor" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="txtApellidoMProveedor" required>
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div> 
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Numero de tel.</span>
                        <input id="txtNumeroProveedor" maxlength="10" type="number" placeholder="Numero de telefono" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="txtNumeroProveedor" required>
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div> 
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Correo Electrónico</span>
                        <input type="email" maxlength="30" class="form-control" placeholder="CHAPAS@hotmail.com" aria-label="Username" aria-describedby="basic-addon1" id="txtCorreoProveedor" name="txtCorreoProveedor" required>                        
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div>                
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <p class="px-3">
                <h6>Información del domicilio</h6>
            </p>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Numero</span>
                        <input id="numeroProveedor" placeholder="numero del lugar" type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="numeroProveedor" required>                        
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">calle</span>
                        <input id="calleProveedor" type="text" placeholder="calle del lugar" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="calleProveedor" required>                        
                    </div>
                    <label class="text-danger" for="basic-url">*Campo obligatorio</label>
                </div> 
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="inputGroupSelect01">Estado</label>
                        <select class="form-select" id="estadoProveedor" name="estadoProveedor">
                            <option value = "0" selected>Seleccione un estado</option>
                            @foreach($listaEstados as $estado)
                                <option value = "{{$estado->id}}" selected>{{$estado->nombre}}</option>
                            @endforeach                        
                        </select>                        
                    </div>
                    <label class="text-danger" for="basic-url">*Selección obligatoria</label>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="inputGroupSelect01">Municipio</label>
                        <select  id="muncipioProveedor" disabled="true" class="form-select"  name="muncipioProveedor">
                            <option value = "0" selected>Seleccione un municipio</option>                        
                        </select>
                    </div>
                    <label class="text-danger" for="basic-url">*Selección obligatoria</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="inputGroupSelect01">Colonia</label>
                        <select class="form-select" disabled="true" id="coloniaProveedor" name="coloniaProveedor">
                            <option value = "0" selected>Seleccione una colonia</option>                        
                        </select>
                    </div>
                    <label class="text-danger" for="basic-url">*Selección obligatoria</label>
                </div>                
            </div>
        </div>
    @endslot
    @slot('footerModal')
    @csrf
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Regresar" data-bs-target="#registroProductoModal" data-bs-toggle="modal" data-bs-dismiss="modal" />    
        <x-button-normal-form id="btnAgregarProveedor" type="submit" estiloBoton="btn-outline-primary" texto="Registrar" /> 
        </form>  
    @endslot
    @endcomponent
    <x-modalSimple idModal="confirmacionModal" tituloModal="Borrar registro">
        <x-slot name="cuerpoModal">
        <div class = "container">
                <div class = "row">
                    <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                        <h6>¿Seguro que quieres eliminar el registro?</h6>
                    </div>
                </div>
                
                <div class = "row">
                    <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                        <h6>Los cambios no se pueden deshacer</h6>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footerModal">
            <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" />
            <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Confirmar" id="botonModalConfirmacion" />
        </x-slot>
    </x-modalSimple>
    <!--Modal cambios-->
    <x-modalSimple idModal="confirmacionModificacion" tituloModal="Modificar registro">
        <x-slot name="cuerpoModal">
            <div class = "container">
                <div class = "row">
                    <div class="col-md-12 col-sm-12  d-flex justify-content-center">
                        <h6>¿Seguro que quieres modificar el registro?</h6>
                    </div>
                </div>
                
                <div class = "row">
                    <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                        <h6>Los cambios no se pueden deshacer</h6>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footerModal">
            <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" data-bs-target="#registroProductoModal" data-bs-toggle="modal"/>
            <x-button-normal-form type="submit" id="btnGuardar" estiloBoton="btn-outline-primary" texto="Confirmar"/>
        </x-slot>
    </x-modalSimple>
@endsection

@section('scritps')
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/minAjax.js"></script>
    <script src="./js/validaciones/productos.js"></script>
@endsection