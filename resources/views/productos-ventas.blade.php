@extends('rootview')

<!--Contenido del header. &#128276;-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
        <li class="nav-item">
            <a class="nav-link active" href="../productos">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../proveedores">Proveedores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../ventas">Ventas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../usuarios">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../notificaciones"> 
                    <span class="icon">&#128276;</span> 
                    Notificaciones
            </a>
        </li>
    @endslot
  
    <!--Esta parte es para mostrar el boton de log out-->
    @slot('visible',true)
  @endcomponent
@endsection


@section('contenido')
    <h5 class="h5 text-star mt-5 ps-3">
        <span>&#128075;</span>   
        ¡Hola, XXXX XXXX XXXX!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#127991;</span>
        Productos
    </h5>

    <div class="container-fluid mb-4">
        <form action="" class="row d-flex justify-content-end">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="PlaceHolder">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                    <span class="me-3">&#128269</span>  
                    Buscar
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
                        <th scope="col">Clave Producto</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Clasificación</th>
                        <th scope="col">Cantidad existencia</th>                                     
                        <th scope="col">Agregar al carrito</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">asdcsdc</th>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>                                              
                        <td><span>&#128276;</span></td>                        
                    </tr>
                    <tr>
                        <th scope="row">asdcsdc</th>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>                                              
                        <td><span>&#128276;</span></td>                        
                    </tr>
                    <tr>
                        <th scope="row">asdcsdc</th>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>
                        <td>asdcsdc</td>                                              
                        <td><span>&#128276;</span></td>                        
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>
<!--
    @component('components.modal')
    @slot('idModal','registroProductoModal')
    @slot('tituloModal','Registrar un nuevo producto')
    @slot('cuerpoModal')    
        <p class="px-3">
            Formulario para registrar a un nuevo producto
        </p>
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Clave producto</span>
                        <input id ="inClaveProducto" maxlength="10" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre de producto</span>
                        <input id ="inNomProducto" maxlength="20" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Clasificación</span>
                        <input id ="inClasificacion" type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Precio</span>
                        <input id ="inPrecio" type="number" step="0.01" class="form-control" value="0.00" placeholder="" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div> 

            <div class="row">
            <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Cantidad en existencia</span>
                        <input id ="inCantExistencia" type="number" class="form-control" value="0" placeholder="" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>               
            </div> 
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Proveedores</label>
                <select class="form-select" id="inputGroupSelect01">
                    <option selected>Seleccione un proveedor</option>
                    <option value="1">Proveedor 1</option>
                    <option value="2">Proveedor 2</option>
                    <option value="3">Proveedor 3</option>
                </select>
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
@endsection
-->
@section('scritps')
    <script src="./js/validaciones/productos.js"></script>
@endsection