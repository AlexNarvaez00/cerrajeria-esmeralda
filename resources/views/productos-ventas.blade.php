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
                @foreach($registrosProductos as $producto)
                    <!--Inicio de la Fila-->
                    <tr>
                        <!--ID de la tabla usuarios-->    
                        <th scope="col">{{$producto->clave_producto}}</th>
                        <!--Los otros atributos de la tabla usuarios-->
                        <td>{{$producto->nombre_producto}}</td>
                        <td>{{$producto->clasificacion}}</td>
                        <td>&#36;{{$producto->precio_producto}}</td>
                        <td>{{$producto->cantidad_existencia}}</td>                        
                        <!--Botones-->
                        <td>
                            <button class="btn" data-id-db="{{$producto->clave_producto}}">
                                <span><i class="bi bi-cart4" style="font-size:20px;" data-bs-toggle="modal" data-bs-target="#agregarcarritoModal"></i></span>
                            </button>
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
            Fecha de compra:  <?php echo date("Y-n-j");?>
        </p>
        <ul class="list-group">
  <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
</ul>
    @endslot
    @slot('footerModal')
        Total a pagar: $0.00
        <button type="button" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Realizar venta
        </button>
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Eliminar carrito
        </button>
        
    @endslot
    @endcomponent
    <!-- modal para agregar un producto al carrito-->
    @component('components.modal')
    @slot('idModal','agregarcarritoModal')
    @slot('tituloModal','Agregar a carrito')
    @slot('rutaEnvio',route('productos.store'))
    @slot('metodoFormulario','POST')
    @slot('cuerpoModal')
    <div class="container-fluid">
        <div class="row">
        @csrf
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
    @endslot
    @endcomponent
@endsection



@section('scritps')
    <script src="./js/validaciones/productos.js"></script>
@endsection