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
        ¡Hola, XXXX XXXX XXXX!
    </h5>
    <h5 class="h5 text-star mt-3 mb-5 ps-3 ">
        <span>&#127991;</span>
        Venta de Productos
    </h5>

    <div class="container-fluid mb-4">
        <div class ="row">
            <div class="col-3 d-flex justify-content-start">        
                <button type="button" class="bi bi-cart4 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#carritoModal"> Ver carrito <span class="badge">4</span></button>           
            </div> 
            <form action="" class="col-9 d-flex justify-content-end">                   
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
                @foreach($registrosProductosDescripcionjoin as $producto)
                    <!--Inicio de la Fila-->
                    <tr>
                        <!--registros de las tablas-->    
                        <th class="dato" scope="col">{{$producto->clave_producto}}</th>                        
                        <td class="dato">{{$producto->nombre_producto}}</td>                        
                        <td class="dato">&#36;{{$producto->precio_producto}}</td>
                        <td class="dato">{{$producto->cantidad_existencia}}</td> 
                        <td class="dato">{{$producto->descripcion}}</td>                       
                        <!--Boton de carrito-->
                        <td>
                            <form class="form-carrito" method="POST" action="{{route('productos.index')}}">                      
                                <button type = "button" class="btn" data-id-db="{{$producto->clave_producto}}">
                                    <span><i  class="bi bi-cart4" style="font-size:20px;" data-bs-toggle="modal" data-bs-target="#agregarcarritoModal"></i></span>
                                </button>     
                            </form>                       
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
        <table class="table table-success table-striped">
            @foreach ($camposproductosCarrito  as $campo)
                <th scope="col">{{$campo}}</th>
            @endforeach  
        </table>        
    @endslot
    @slot('footerModal')
        
        <div class="me-auto p-2 bd-highlight"><h6>Total a pagar: $0.00</h6></div>
        <button type="button" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Realizar pago
        </button>
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
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
        <div class="row">        
            <p class="px-3">
                <h4 id="letreroNombre">Aqui va el nombre del producto</h4>
            </p>
            
            <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 ">
                    <span class="input-group-text" id="basic-addon1">Cantidad</span>
                    <input id ="inCantExistencia" type="number" class="form-control" value="1" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="cantidad_existencia" required>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-text">Observaciones</span>
                <textarea class="form-control" aria-label="With textarea"></textarea>
            </div>         
        
        </div>
    <div>
        
    @endslot
    @slot('footerModal')
    <tr>
    <button type="reset" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
        <i class="bi bi-plus-lg " style="font-size:20px;"></i>
            Agregar
        </button>
    @endslot
    @endcomponent
@endsection



@section('scritps')
    <script src="./js/validaciones/productos.js"></script>
    <script>
        
         const formulariosAgregarCarrito = document.getElementsByClassName('form-carrito');
                 
        let cuerpoModalInformacion = document.querySelector('#agregarcarritoModal .modal-body')
        let FORMULARIO_GLOBAL = null;
        for (let index = 0; index < formulariosAgregarCarrito.length; index++) {
            //document.getElementById('letreroNombre').innerHTML = 'Hola :3'; 
            //console.log(document.getElementById('letreroNombre').innerHTML);
            const productoCarrito = formulariosAgregarCarrito[index];
            //Agregamos el vento de submit a cada "formulario" de las filas 
            //en los registros de la tabla
            productoCarrito.addEventListener('submit',(event)=>{
                event.preventDefault();//Evitamos que el formulario envie cosas.
                const filaHTML = event
                                    .target
                                    .parentNode
                                    .parentNode;
                const registros = filaHTML.getElementsByClassName('dato');                 
                document.getElementById('letreroNombre').innerHTML = 'Nombre del producto: ' + registros[1].innerHTML;
                console.log(document.getElementById('letreroNombre'));
                //Colocar la informacion en el modal.
                /*for (let index = 0; index < registros.length; index++) {
                    registros[index];
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

                }*/
                FORMULARIO_GLOBAL = event.target;                
            });

        }
       

    </script>
@endsection