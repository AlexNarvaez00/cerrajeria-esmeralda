@extends('rootview')

<!--Contenido del header. &#128276;-->
@section('header-seccion')
  <!--Esta es la prte del boton de log out -->
  @component('components.header')
    @slot('items')
    @component('components.itemsNavBar')
        @slot('active','ventas')
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
        <span>&#127991;</span>
        Venta de Productos
    </h5>

    <div class="container-fluid mb-4">
        <div class ="row">
            <div class="col-3 d-flex justify-content-start">        
                <button type="button" class="bi bi-cart4 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#carritoModal"> Ver carrito <span id ="conProductos" class="badge">0</span></button>           
            </div> 
            <form action="" class="col-9 d-flex justify-content-end">                   
                <div class="col-5">
                    <input type="text" class="form-control" placeholder="Buscar producto">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
                        <span class="me-3">&#128269</span>  
                        Buscar
                    </button>
                </div>              
            </form>
        </div>       
    </div>

    <!--Seccion de la tabla-->
    <div class="conteiner-fluid">
        <div class="col-12 text-center">
            <table class="table">
                <thead>
                    <tr>
                    @foreach ($camposProductos as $campo)
                        <th scope="col">{{$campo}}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <!--Inicio de la Fila-->
                        <tr>
                            <!--registros de las tablas-->    
                            <th class="dato" scope="col">{{$producto->clave_producto}}</th>                        
                            <td class="dato">{{$producto->nombre_producto}}</td>                        
                            <td class="dato">&#36;{{$producto->precio_producto}}</td>
                            <td class="dato">&#36;{{$producto->precio_compra}}</td>
                            <td class="dato">{{$producto->cantidad_existencia}}</td>  
                            <td class="dato">{{$producto->cantidad_stock}}</td>                                                  
                            <!--Boton de carrito  -->
                            <td>
                                <a class = "btnAgregarAlCarro">                                                     
                                    <button type="button" class="btn" >
                                        <span><i  class="bi bi-cart4" style="font-size:20px;"  ></i></span>
                                    </button>  
                                </a>                                                     
                            </td>                
                        </tr>
                    @endforeach
                </tbody>
                <!---->
            </table>
        </div>
    </div>
<!-- modal para listar los productos en el carrito-->
    @component('components.modal')
    @slot('idModal','carritoModal')
    @slot('tituloModal','Carrito de compras')
    @slot('rutaEnvio',route('productos-ventas.store'))
    @slot('metodoFormulario','POST')
    @slot('cuerpoModal')           
        <p class="px-3">
            Fecha de compra:  <?php echo date("j-n-Y");?>
        </p>
        <div class="col-12 text-center">
            <table id = "tabla" class="table table-success table-striped">
                @foreach ($camposproductosCarrito  as $campo)
                    <th scope="col">{{$campo}}</th>
                @endforeach  
                <tbody>
                </tbody>
            </table>   
        </div>     
    @endslot
    @slot('footerModal')
        <div class="me-auto p-2 bd-highlight"><h6 id="letreroTotal">Total a pagar: $0.00</h6></div>
        <button type="button" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Realizar pago
        </button>
        <button id="btnEliminarCarrito"type="reset" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Eliminar carrito
        </button>
    @endslot
    @endcomponent
    <!-- modal para agregar un producto al carrito-->
    @component('components.modalSimple')
    @slot('idModal','agregarcarritoModal')
    @slot('tituloModal','Agregar al carrito')
    @slot('cuerpoModal')
    
    <div class="container-fluid">
        <div class = "row">
            <div class="col-md-12 col-sm-12  d-flex justify-content-center">
                <h6 id="letreroConfirmacion"></h6>                        
            </div>  
                                       
        </div>
    
        
    <div>
        
    @endslot
    @slot('footerModal')
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" />
        <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Agregar" id="btnConfirmacionCarro" />
    @endslot
    @endcomponent
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">    
                <strong class="me-auto">&#10060 Error</strong>      
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Agraga mas productos al inventario
            </div>
        </div>
    </div>

@endsection

@section('scritps')   
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/minAjax.js"></script>
    <script src="./js/validaciones/productos.js"></script>    
    <script src="./js/modales/mostrarModalProdVentas.js" ></script>
@endsection