@extends('rootview')

<!--Contenido del header.-->
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
<!--Encabezado bienvenida-->
<h5 class="h5 text-star mt-5 ps-3">
  <span>&#128075;</span>   
  ¡Hola, {{ auth()->user()->name}}!
</h5>
<!--Titulo modulo-->
<h5 class="h5 text-star mt-3 mb-5 ps-3 ">
  <span>&#129520;</span> Venta de servicios  
</h5>

<div class="container-fluid mb-4">     

  <form action="" class="row d-flex justify-content-end">

    <div class="col-5">
      <input type="text" class="form-control" placeholder="Buscar servicio" name="inputBusqueda">
    </div>

    <div class="col-auto">
      <button type="submit" class="btn btn-light d-flex ps-3 pe-3">
        <span class="me-3">&#128269</span> Buscar
      </button>
    </div>
    
    <div class="col-auto">
      <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroServicioModal">
        <span class="me-3">&#10133;</span>Agregar
      </button>
    </div>
  </form>
</div>
    <!--Tabla-->
<div class="conteiner-fluid">
  <div class="col-12 text-center">
  <table class="table">
      <thead>
        <tr>
          @foreach ($camposTabla as $campo)
          <th scope="col">{{$campo}}</th>
          @endforeach
        </tr>
      </thead>

      <tbody>
      @foreach($serviciosLista as $servicio)
      <!--Inicio de la Fila-->
      <tr>
        <!--ID de la tabla Proveedor-->    
        <th scope="col" class="data">{{$servicio->idservicio}}</th>
        <!--Los otros atributos de la tabla proveedor-->
        <td class="data">{{$servicio->fechayhora}}</td>
        <td class="data">{{$servicio->iddireccion}}</td>
        <td class="data">${{$servicio->monto}}</td>
        <td class="data">{{$servicio->descripcion}}</td>
        <td class="data">{{$servicio->idcliente}}</td> 
        <!--Botones--> 
        <td class="data">
        <a class="btnDetalleCliente">
          <button class="btn" data-bs-toggle="modal" data-bs-target="#modalcliente">
            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Informacion del cliente">&#128065;</span>
          </button>
        </a>
        </td> 
        <td class="data">
          <a class="btnDetalleServicio">
            <button class="btn" data-bs-toggle="modal" data-bs-target="#modalservicio">
              <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detalle servicio">&#128736;</span>
            </button>
          </a>
        </td>                                          
      </tr>
      @endforeach        
      </tbody>
    </table>
    {{$serviciosLista->links()}}
  
  </div>
</div>
    @component('components.modal')
    @slot('idModal','registroServicioModal')
    @slot('tituloModal','Agregar un nuevo servicio')
    @slot('rutaEnvio',route('servicios-ventas.store'))
    @slot('metodoFormulario','POST')
    @slot('cuerpoModal')  
    Fecha solicitud servicio:  <?php echo date("j-n-Y");?>  
    <hr class="rounded"> 
    <div class="container-fluid">
      <label class="text-danger" for="basic-url">* Campos obligatorios</label>
    </div>
    <hr>
    <!--Formulario para agregar datos al cliente-->  
    <div class="container-fluid">
      <h4 class="d-flex justify-content-center">Datos del cliente</h4>
      <div class="row">
       
        @csrf
          <div class="col-md-5 col-sm-12">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
              <label class="form-check-label" for="flexSwitchCheckDefault">¿El cliente ya se registro?</label>
            </div>
          </div>
          
          <div class="col-md-5 col-sm-12">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">idCliente</span>
              <input disabled="true" type="text" class="form-control" placeholder="Ejemp. cl-atat" aria-label="Username" aria-describedby="basic-addon1" id="inputIdCliente" name="idCliente" required>
            </div>            
          </div>

            <div class="col-md-2 col-sm-12">
              <button type="button" class="btn btn-light d-flex ps-3 pe-3" disabled="true" id="btnBuscarCliente">
                    <span class="me-3">&#128269</span>                  
              </button>
            </div>
        
      </div>  

      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1">
            <span class="input-group-text" id="basic-addon1">Nombre</span>
            <input type="text" maxlength="30" class="form-control" placeholder="Ejemp. Juan" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreCliente" name="nombre" required>
            <h5 class="text-danger" for="basic-url">*</h5>
          </div>   
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1">
            <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
            <input type="text" maxlength="30"  class="form-control" placeholder="Ejemp. Martinez" aria-label="Username" aria-describedby="basic-addon1" id="inputApellidoPCliente" name="apellidoP">
            <h5 class="text-danger" for="basic-url">*</h5>
          </div>       
        </div>

      </div>
    <br>
      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1">
            <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
              <input type="text" maxlength="30" class="form-control" placeholder="Ejemp. Martinez" aria-label="Username" aria-describedby="basic-addon1"id="inputApellidoMCliente" name="apellidoM">
              <h5 class="text-danger" for="basic-url">*</h5>
            </div>          
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1">
            <span class="input-group-text" id="basic-addon1">Número de teléfono</span>
            <input type="number" maxlength="10"  class="form-control" placeholder="Ej. 9514628538" aria-label="Username" aria-describedby="basic-addon1" id="inputNumTelefono" name="telefono">
            <h5 class="text-danger" for="basic-url">*</h5>
          </div>          
        </div>

      </div>

    </div>
    <hr class="rounded"> 
    <!--Formulario para agregar datos del lugar-->  
    <div class="container-fluid">

      <h4 class="d-flex justify-content-center">Datos del lugar</h4>

      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1 col-md-12 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Calle</span>
            <input type="text" class="form-control" placeholder="ejem. Constitución" aria-label="Username" aria-describedby="basic-addon1" id="inputCalle" name="calle" required>
            <h5 class="text-danger" for="basic-url">*</h5>
          </div>          
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1 col-md-12 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Número ext</span>
            <input type="text" class="form-control" min="1" placeholder="ejemp. 123" aria-label="Username" aria-describedby="basic-addon1" id="inputNumExt" name="numero" required>
            <h5 class="text-danger" for="basic-url">*</h5>
          </div>          
        </div>
      </div>
      <br>
      <div class="row">

      <div class="col-md-6 col-sm-12">
        <div class="input-group mb-1">
          <label class="input-group-text" for="inputEstado">Estado</label>
            <select id="inputEstado" class="form-select" name="estados" value="">
              <option selected value="0">Selecciona un estado</option>
              @foreach($registroEstados as $lugarCliente)
              <option value="{{$lugarCliente->id}}">{{$lugarCliente->nombre}} </option>                    
              @endforeach
            </select>
            <h5 class="text-danger" for="basic-url">*</h5>
        </div>        
      </div> 

      <div class="col-md-6 col-sm-12">
        <div class="input-group mb-1">
          <label class="input-group-text" for="idMunicipio">Municipio</label>
          <select id="idMunicipio" class="form-select" name="municipios">
            <option selected value="0">Selecciona un municipio</option>               
          </select>
          <h5 class="text-danger" for="basic-url">*</h5>
        </div>       
      </div>
      

    </div>
    <br>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class="input-group mb-1">
          <label class="input-group-text" for="idColonia">Colonia</label>
          <select id="idColonia" class="form-select" name="colonia">
            <option selected value="0">Selecciona una colonia</option>
          </select>
          <h5 class="text-danger" for="basic-url">*</h5>
        </div>        
      </div>
    </div>
    <hr class="rounded"> 
    <!--Formulario para agregar datos del servicio--> 
    <div class="container-fluid">
      <h4 class="d-flex justify-content-center">Datos del servicio</h4>

      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-3 ">
            <span class="input-group-text" id="basic-addon1">Monto del servicio</span>
            <input id ="inPrecio" type="number" min="1" step="0.01" class="form-control" value="0.00"  aria-label="Username" aria-describedby="basic-addon1" name="monto" onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 190)" required>
            <h5 class="text-danger" for="basic-url">*</h5>
          </div>
        </div>

        <div class="input-group">
          <span class="input-group-text">Descripción</span>
          <textarea id="areaDescripcion" class="form-control" placeholder="Puedes agregar referencias del lugar o alguna observación" aria-label="With textarea" name="descripcion" required></textarea>
          <h5 class="text-danger" for="basic-url">*</h5>
        </div>    
      </div>
    </div> 
    @endslot
    @slot('footerModal')
    <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar"/>    
    <x-button-normal-form id="btnAgregarProveedor" type="submit" estiloBoton="btn-outline-primary" texto="Registrar" /> 
    @endslot
    @endcomponent
    @component('components.modalSimple')
    @slot('idModal','modalservicio')
    @slot('tituloModal','Detalles del servicio')
    @slot('cuerpoModal')
    <div class="container-fluid">
    <h6 id="letreroDetalleFecha"></h6>
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-3 ">
            <span class="input-group-text" id="basic-addon1">id del servicio</span>
            <input id ="inDetalleIDservicio" type="text" disabled="true" min="1" step="0.01" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-3 ">
            <span class="input-group-text" id="basic-addon1">Subtotal del servicio $</span>
            <input id ="inSubtotal" type="number" min="1" step="0.01" class="form-control" value="0.00"  aria-label="Username" aria-describedby="basic-addon1" onkeypress="return ((event.charCode >= 48 && event.charCode <= 57))" required>
            <h5 class="text-danger" for="basic-url">*</h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="input-group">
          <span class="input-group-text">Descripción</span>
          <textarea id="inareaDescripcionDetalle" class="form-control" placeholder="Puedes agregar referencias del lugar o alguna observación" aria-label="With textarea" required></textarea>
          <h5 class="text-danger" for="basic-url">*</h5>
        </div> 
        </div>    
    </div>
    @endslot
    @slot('footerModal')
      <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cerrar" data-bs-dismiss="modal"/>  
      <!---->  
      <x-button-normal-form type="submit" id="btnRealizarVenta" estiloBoton="btn-outline-primary" texto="Realizar venta" data-bs-toggle="modal" data-bs-target="#confirmacionventaservicio"/> 
    @endslot
    @endcomponent

    @component('components.modalSimple')
    @slot('idModal','modalcliente')
    @slot('tituloModal','Detalles del cliente')
    @slot('cuerpoModal')
    <div class="container-fluid">
    <h5>Datos del cliente</h5>
      <div class = "row">
        <div class="col-md-5 col-sm-12">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">idCliente</span>
              <input disabled="true" id="infoIdCliente" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
            </div>            
        </div>
      </div>
      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nombre</span>
            <input disabled="true" id="infoNombre" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">            
          </div>   
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
            <input disabled="true" id="infoAP" type="text" id="infoAP" class="form-control" aria-label="Username" aria-describedby="basic-addon1">           
          </div>       
        </div>

      </div>
      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
              <input disabled="true" type="text" id="infoAM" class="form-control" aria-label="Username" aria-describedby="basic-addon1">              
            </div>          
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Número de teléfono</span>
            <input disabled="true" type="number" id="infoTel" class="form-control" aria-label="Username" aria-describedby="basic-addon1">            
          </div>          
        </div>
      </div>
      <hr>
      <div class="container-fluid">

      <h4 class="d-flex justify-content-center">Datos del lugar</h4>

      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1 col-md-12 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Calle</span>
            <input disabled="true" id="infoCalle" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>           
          </div>          
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="input-group mb-1 col-md-12 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Número ext</span>
            <input disabled="true" type="text" id="infoNumEx" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
            
          </div>          
        </div>
      </div>
      <br>
      <div class="row">

      <div class="col-md-6 col-sm-12">
        <div class="input-group mb-1 col-md-12 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Estado</span>
            <input disabled="true" id="infoEstado" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>           
          </div>       
      </div> 

      <div class="col-md-6 col-sm-12">
        <div class="input-group mb-1 col-md-12 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Muncipio</span>
            <input disabled="true" id="infoMunicipio" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>           
          </div>   
      </div>     

    </div>
    <br>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class="input-group mb-1 col-md-12 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Colonia</span>
            <input disabled="true" id="infoColonia" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>           
          </div>          
      </div>
    </div>
    </div>
    @endslot
    @slot('footerModal')
      <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cerrar" data-bs-dismiss="modal"/>   
    @endslot
    @endcomponent
    <!-- Modal -->
    <div class="modal fade" id="btnTerminarVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Confirmar venta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Verifica que los datos sean correctos
          </div>
          <div class="modal-footer">
            <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Cancelar" data-bs-target="#confirmacionventaservicio" data-bs-toggle="modal" data-bs-dismiss="modal"/>  
            <x-button-normal-form type="submit" id="btnFinalizarVenta" estiloBoton="btn-outline-primary" texto="Finalizar venta" /> 
          </div>
        </div>
      </div>
    </div>
    @component('components.modalSimple')
    @slot('idModal','confirmacionventaservicio')
    @slot('tituloModal','Confirmar venta')
    @slot('cuerpoModal')
      <form>
        <div class="container">
          <h6>Ingrese el monto</h6>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">Total a pagar $</span>
                <input id ="inTotalPagar" type="number" min="1" step="0.01" class="form-control" value="0.00"  aria-label="Username" aria-describedby="basic-addon1" readonly>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="input-group mb-3 ">
                <span class="input-group-text" id="basic-addon1">Monto recibido $</span>
                <input id ="inMontoRecibido" type="number" min="1" step="0.01" class="form-control" value="0.00"  aria-label="Username" onkeypress="return (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 190)" aria-describedby="basic-addon1" required>
                <h5 class="text-danger" for="basic-url">*</h5>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <h4 id="letreroCambio">Cambio $0.00</h4>
            </div>
          </div>
        </div>     
      </form>   
    @endslot
    @slot('footerModal')     
      <x-button-normal-form type="reset" estiloBoton="btn-outline-danger" texto="Regresar" data-bs-target="#modalservicio" data-bs-toggle="modal" data-bs-dismiss="modal"/>   
      <x-button-normal-form type="submit" estiloBoton="btn-outline-primary" texto="Finalizar venta" data-bs-target="#btnTerminarVenta" data-bs-toggle="modal" data-bs-dismiss="modal" /> 
    @endslot
    @endcomponent

@endsection
@section('scritps')
<script src="./js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./js/minAjax.js"></script>
<script src="./js/funciones/servicios-ventas.js"></script>    
@endsection