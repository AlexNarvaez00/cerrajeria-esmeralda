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
                <button type="button" id ="btnCarrito" class="bi bi-cart4 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#carritoModal"> Ver carrito <span id ="conProductos" class="badge">0</span></button>           
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
                                    <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Agregar al carrito">
                                        <span><i  class="bi bi-cart4" style="font-size:20px;"></i></span>
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
    @component('components.modalSimple')
    @slot('idModal','verificarCompra')
    @slot('tituloModal','Verifica que la venta sea correcta')
    @slot('cuerpoModal')          
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cantidad recibida $</label>
                        <input type="number" value="0.00" class="form-control" id="cantidadRecibida" min="0" step="0.01" required>
                        <div class="form-text">* Campo obligatorio</div>
                    </div>
                </div>                
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="col-12 text-center">
                <table id = "tabla2" class="table table-warning table-striped">
                    <thead>
                        <tr>
                        @foreach ($camposValidar as $campo)
                            <th scope="col">{{$campo}}</th>
                        @endforeach 
                        </tr>
                    </thead> 
                    <tbody>
                    </tbody>
                </table>   
            </div> 
        </div> 
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                    <h4 id="letreroTotalConfirmacion">Total a pagar: $0.00</h4>
                </div>                
            </div>  
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                    <h4 id="letreroCambio">Cambio: $0.00</h4>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 d-flex justify-content-center">
                    <h5>No se aceptan devoluciones</h5>
                </div>                
            </div>                          
        </div>   
        @endslot
    @slot('footerModal')        
        <x-button-normal-form type="reset" estiloBoton="btn-outline-success" texto="Regresar"  data-bs-target="#carritoModal" data-bs-toggle="modal" data-bs-dismiss="modal"/>
        <x-button-normal-form type="button" disabled="true" id="btnFinalizarCompra" estiloBoton="btn-outline-primary" texto="Finalizar compra"  data-bs-target="#detalleCompras" data-bs-toggle="modal" data-bs-dismiss="modal"/>         
    @endslot    
    @endcomponent
    <!-- modal para listar los productos en el carrito -->
    @component('components.modalSimple')
    @slot('idModal','carritoModal')
    @slot('tituloModal','Carrito de compras')
    @slot('cuerpoModal')           
        <p class="px-3">
            Fecha de compra:  <?php echo date("j-n-Y");?>
        </p>
        <div class="container-fluid">
            <div class="col-12 text-center">
                <table id = "tabla" class="table table-warning table-striped">
                    <thead>
                        <tr>
                        @foreach ($camposproductosCarrito  as $campo)
                            <th scope="col">{{$campo}}</th>
                        @endforeach 
                        </tr>
                    </thead> 
                    <tbody>
                    </tbody>
                </table>   
            </div> 
        </div> 
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                    <h4 id="letreroTotal">Total a pagar: $0.00</h4>
                </div>                
            </div>                          
        </div>   
    @endslot
    @slot('footerModal')        
        <x-button-normal-form type="reset" estiloBoton="btn-outline-success" texto="Seguir comprando"  data-bs-dismiss="modal"/>
        <x-button-normal-form type="button" id="btnRealizarVenta" estiloBoton="btn-outline-primary" texto="Realizar venta"  data-bs-target="#verificarCompra" data-bs-toggle="modal" data-bs-dismiss="modal"/>         
    @endslot    
    @endcomponent

    <!--Modal detalle compra-->
    @component('components.modalSimple')
    @slot('idModal','detalleCompras')
    @slot('tituloModal','Detalle compra')
    @slot('cuerpoModal') 
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12  d-flex justify-content-center">
                    <h4> <span class="fs-1 me-2"> <i class="bi bi-key"></i> </span>Cerrajeria Profesional Esmeralda</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12  d-flex justify-content-center">
                    <p>calle obsidiana, S/N, hacienda blanca, fraccionamiento Esmeralda, Oaxaca de Juárez, Oax</p>
                </div>
            </div>
        </div>  
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-6  justify-content-start">
                <h6 id="letreroIdCompra">IdCompra: </h6> 
                </div>  
                <div class="col-md-6 col-sm-6  justify-content-start">
                <h6 id="idDetallecompra"></h6>
                </div>              
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6  justify-content-start">
                <p id="letreroIdEmpleado">idempleado: {{ auth()->user()->id}}</p>
                </div>
                <div class="col-md-6 col-sm-6  d-flex justify-content-end">
                <?php
                    $DateAndTime = date('m-d-Y h:i:s a', time());  
                    echo "Fecha y hora: ".$DateAndTime;
                ?>
                </div>
            </div>
            <hr>
            <div class="container-fluid" id="descripcionProductosDetalleCompra">
                <div class="row">
                    <div class="col-md-1 col-sm-1  justify-content-start">
                        Cant.
                    </div>
                    <div class="col-md-5 col-sm-5  justify-content-start">
                        Descripcion
                    </div>
                    <div class="col-md-3 col-sm-3  justify-content-start">
                        Precio unitario
                    </div>
                    <div class="col-md-3 col-sm-3  justify-content-start">
                        Importe
                    </div>
                </div>
            </div>            
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12  d-flex justify-content-end">
                    <p id="letreroCantidadRecibida">recibido: $200.00</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12  d-flex justify-content-end">
                    <p id="letreroCantidadCambio">cambio: $100.00</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12  d-flex justify-content-end">
                    <p id="letreroTotalPagar">total a pagar: $100.00</p>
                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12  d-flex justify-content-center">
                        <p>¡Gracias por su compra!</p>
                    </div>
                </div>
            </div>
        </div>
    @endslot
    @slot('footerModal')
        <x-button-normal-form  type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal" id="btnCerrarTicket"/>
        <x-button-normal-form  type="button" estiloBoton="btn-outline-primary" texto="Imprimir recibo" id="btnImprimirTicket"/>        
    @endslot
    @endcomponent
    
    <!-- modal para agregar un producto al carrito-->
    @component('components.modalSimple')
    @slot('idModal','agregarcarritoModal')
    @slot('tituloModal','Agregar al carrito')
    @slot('cuerpoModal')    
    <div class="container-fluid">
        <div class = "row">            
            <div class="col-md-6 col-sm-6  d-flex justify-content-end">
                <h6>Id del producto: </h6>                        
            </div>
            <div class="col-md-6 col-sm-6 d-flex justify-content-start">
                <h6 id="letreroIdProducto" class="font-weight-bold"></h6>                        
            </div>                                        
        </div> 
        <div class = "row">            
            <div class="col-md-12 col-sm-12  d-flex justify-content-center">
                <h6 id="letreroConfirmacion"></h6>                        
            </div>                                      
        </div>       
    <div>        
    @endslot
    @slot('footerModal')
        <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-dismiss="modal"/>
        <x-button-normal-form type="button" estiloBoton="btn-outline-primary" texto="Confirmar" id="btnConfirmacionCarro" data-bs-dismiss="modal"/>
        
    @endslot
    @endcomponent
    <!-- modal para confirmar la compra-->
    

   
    


@endsection


@section('scritps')   
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/minAjax.js"></script>
    <script src="./js/validaciones/productos.js"></script>    
    <script src="./js/modales/mostrarModalProdVentas.js" ></script>
@endsection