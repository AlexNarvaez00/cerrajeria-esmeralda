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
                <input type="text" class="form-control" placeholder="Buscar producto" name="inputBusqueda">
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
                @foreach($registrosProductosjoin as $producto)
                    <!--Inicio de la Fila-->
                    <tr>
                        <!--ID de la tabla usuarios-->    
                        <th class="dato" scope="col">{{$producto->clave_producto}}</th>
                        <!--Los otros atributos de la tabla usuarios-->
                        <td class="dato">{{$producto->nombre_producto}}</td>
                        <td class="dato">{{$producto->clasificacion}}</td>
                        <td class="dato">&#36;{{$producto->precio_producto}}</td>
                        <td class="dato">{{$producto->cantidad_existencia}}</td>
                        <td class="dato">{{$producto->idproveedor}}</td>                     
                        
                        <!--Botones-->
                        <td class="btnDetalles">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#verdetalles">
                                <span>&#128065;</span>
                            </button>
                        </td>
                        <td>
                            <a class="btnEditar">                                
                                <button type = "button" class="btn" data-bs-toggle="modal" data-bs-target="#registroProductoModal">
                                    <span>&#128394;</span>
                                </button>
                            </a>
                        </td>
                        <td>
                            <button class="btn">
                                <span>&#10060;</span>
                            </button>
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
   
        <p class="px-3">
            Formulario para registrar a un nuevo producto
        </p>
        <div class="container-fluid">
            <div class="row">
            @csrf
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Clave producto</span>
                        <input id ="inClaveProducto" maxlength="10" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="clave_producto" required>
                    </div>
                </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre de producto</span>
                        <input id ="inNomProducto" maxlength="20" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="nombre_producto" required>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Clasificación</span>
                        <input id ="inClasificacion" maxlength="20" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="clasificacion">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Precio</span>
                        <input id ="inPrecio" type="number" min="1" step="0.01" class="form-control" value="1.00" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="precio_producto" required>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-6 col-sm-12">
                        <div class="input-group mb-3 ">
                            <span class="input-group-text" id="basic-addon1">Cantidad en existencia</span>
                            <input id ="inCantExistencia" type="number" class="form-control" min = "0" value="0" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="cantidad_existencia" required>
                        </div>
                    </div>          
                
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Proveedores</label>
                        <select class="form-select" id="inputGroupSelect01" name="idproveedor">
                            <option selected>Seleccione un proveedor</option>
                            @foreach($registrosProveedores as $proveedor)
                            <option>{{$proveedor->idproveedor}} {{$proveedor->nombre}} {{$proveedor->apellidopaterno}} {{$proveedor->apellidomaterno}} </option>                    
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class = "row">
                <div class="col-md-12 col-sm-12"> 
                    <div class="input-group">
                        <span class="input-group-text">Descripcion</span>
                        <textarea id="inDescripcion" class="form-control" aria-label="With textarea" placeholder="Puedes agregar la marca, el color, etc." name="descripcion" required></textarea>
                    </div> 
                </div>
            </div>
        </div>
    @endslot
    @slot('footerModal')
        <button type="reset" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <div id="btnRegistrarProducto" style="display:none">
        <button type="submit" class="btn btn-light d-flex ps-3 pe-3" >
            <span class="me-2">&#10004;</span>
            Registrar
        </button>
        </div>
        <div id="btnGuardarCambios" style="display:none">
        <button type="submit" class="btn btn-light d-flex ps-3 pe-3" >
            <span class="me-2">&#128190;</span>
            Guardar Cambios
        </button>
        </div>
    @endslot
    @endcomponent


@component('components.modalSimple')
    @slot('idModal','verdetalles')
    @slot('tituloModal','Detalles del producto')
    @slot('cuerpoModal')
    
    <div class="container-fluid">        
        <div class="row">
         <!--Columnas :v-->
         <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Clave producto</span>
                        <input maxlength="10" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="clave_producto" required>
                    </div>
        </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre de producto</span>
                        <input maxlength="20" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="nombre_producto" required>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Clasificación</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="clasificacion">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Precio</span>
                        <input type="number" step="0.01" class="form-control" value="0.00" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="precio_producto" required>
                    </div>
                </div>
            </div> 

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Cantidad en existencia</span>
                        <input type="number" class="form-control" value="0" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="cantidad_existencia" required>
                    </div>
                </div>   
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Id Proveedor</span>
                        <input maxlength="20" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="nombre_producto" required>
                    </div>
                </div>
            </div>            
            </div> 
            <div class="row">
                <div class="input-group">
                    <span class="input-group-text">Descripcion del producto</span>
                    <textarea id="inDescripcion" class="form-control" aria-label="With textarea" placeholder="Puedes agregar la marca, el color, etc." name="descripcion" required></textarea>
                </div> 
            </div>
            
    <div>
        
    @endslot
    @slot('footerModal')
    @csrf
        <button type="reset" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cerrar
        </button>       
        
    @endslot
    @endcomponent
@endsection


@section('scritps')
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/validaciones/productos.js"></script>
@endsection