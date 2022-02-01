<?php

namespace App\Http\Controllers;

use App\Models\productosModelo;
use App\Models\proveedorModelo;
use App\Models\estadosModelo;
use App\Models\municipiosModelo;
use App\Models\direccionModelo;
use App\Models\coloniaModelo;
use App\Models\productosDescripcionModelo;
use App\Models\telefonoModelo;

use Illuminate\Http\Request;
/**
 * @author Omar 
 */
 /* 
    | -----------------------------------
    |   productosController
    | -----------------------------------
    |   El controlador es utilizado para recuperar
    |   la lista de los productos en el sistema, mostrando
    |   la  informacion basica de los mismo en una tabla.
    |
    */
class productosController extends Controller
{
    /**
     * La lista de productos recuperada de 
     * la base de datos.
     * 
     * @var array 
     */   
    protected $listaProductos;
    /**
     * La lista de proveedores recuperada de 
     * la base de datos.
     * 
     * @var array 
     */   
    protected $proveedorLista;
    /**
     * La lista de descripciones de los productos recuperada de 
     * la base de datos.
     * 
     * @var array 
     */ 
    Protected $listaDescripciones;
    /**
     * Los encabezados para la tabla de la vista
     * productos.
     * 
     * @var array 
     */ 
    private $camposVista;
  
    /**
     * -------------------------------------
     *  Constructor
     * -------------------------------------
     * Carga todos los productos almacenados en la base de datos
     * Carga todos los proveedores almacenados en la base de datos
     * Carga todas las descripciones de los productos almacenados en la base de datos
     * Carga los nombre de los encabezados de la tabla para la vista productos.blade.php
     * 
     */ 
    public function __construct()
    {        
        $this->productosLista = productosModelo::all();
        $this->proveedorLista = proveedorModelo::all();
        $this->descripcionLista = productosDescripcionModelo::all();
        $this->camposVista = ['Clave Producto','Nombre Producto','Clasificación',
        'Precio venta','Precio compra','Existencia','idProveedor','stock','Ver detalles','Editar','Borrar'];
    }

     /**
     * Funcion que ejecutada cuando la ruta de "productos" es 
     * solicitada por el navegador.
     * 
     * @param Request $request Solicitud por parte del navegador.
     * 
     * @return View Vista de productos.
     */
  
    public function index(Request $request)
    {      
        $this->listaProductos = null; //Asigna null a la lista de los productos
        $this->listaDescripciones = null;//Asigna null a la lista de las descripciones de los productos
        $estadosLista = estadosModelo::all(); //Recupera todos los estados de la tabla estados de la bas de datos
        //Verifica si no se realizo una busqueda en la vista de productos retorna todos los productos si no cumple la condición      
        if(count($request->all()) >= 0){
            $this->listaProductos = productosModelo::where('nombre_producto','like',$request->inputBusqueda.'%')->paginate(10);
            $this->listaDescripciones = productosDescripcionModelo::where('clave_producto','like',$request->inputBusqueda.'%')
            ->get();
        }else{        
            $this->listaProductos = productosModelo::paginate(10);
        }       
        return view('productos') //retorna la vista productos          
            ->with('camposVista',$this->camposVista)//retiorna Campos de la tablas
            ->with('registrosProductos',$this->listaProductos)//retorna Registros de la tabla productos  
            ->with('listaEstados',$estadosLista)          
            ->with('registrosProductosDescripciones',$this->listaDescripciones) //retorna Registro de las descripciones de los productos
            ->with('registrosProveedores',$this->proveedorLista);//retorna Registros de la tabla proveedores
    }

    /**
     * Funcion para guardar un nuevo registro en la base de datos.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return Redirect Redirecciona a la vista principal. 
     */
    public function store(Request $request){        
        $producto = new productosModelo();//agrega un modelo productos temporal.
        $productoDescripcion = new productosDescripcionModelo();//agrega un modelo de las descripciones de losproductos temporal.
        //Nombre del campo BD  ----- Nombre input formulario
        $producto->clave_producto = $request->clave_producto;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->clasificacion = $request->clasificacion;
        $producto->precio_producto = $request->precio_producto;
        $producto->precio_compra = $request->precio_compra;
        $producto->cantidad_existencia = $request->cantidad_existencia;
        $producto->cantidad_stock = 2;      
        $producto->idproveedor = explode(" ",$request->idproveedor)[0];       
        $producto->save();//Guarda un nuevo registro en la tabla producto de la base de datos

        //Nombre del campo BD  ----- Nombre input formulario
        $productoDescripcion->clave_producto = $request->clave_producto;
        $productoDescripcion->descripcion = $request->descripcion;
        $productoDescripcion->save();//Guarda un nuevo registro en la tabla productoDescripcion de la base de datos        
        return redirect()->route('productos.index'); //Regirige a la vista principal
    }

    /**
     * Funcion para consultar en la base de datos mediante ajax.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return response retorna la información solicitada desde la vista
     */
    public function getDetalles(Request $request){           
        $descripcionProducto = productosDescripcionModelo::find($request->clave_producto);//recupera la descripcion de un producto
        $proveedor = proveedorModelo::findOrFail($request->idproveedor); //busca a un proveedor
        //Retorna al proveedor y la descripcion en formato json
       
        return response()->json(['data' => ['descripcion'=>$descripcionProducto,'proveedor'=>$proveedor]]);
        
    }

    /**
     * Funcion para consultar en la base de datos mediante ajax.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return response retorna la información solicitada desde la vista
     */
    public function getMunicipios(Request $request)
    {
        $llavePrimaria = $request->id;     //Obtiene un id de la tabla estados   
        //recupera los municipios del estado seleccionado 
        $listaMunicipios = municipiosModelo::where('idestado','=',$llavePrimaria)->get();  
        return response()->json($listaMunicipios); //Retorna la lista de los municipios en formato json
    }

    /**
     * Funcion para consultar en la base de datos mediante ajax.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return response retorna la información solicitada desde la vista
     */
    public function getColonias(Request $request)
    {
        $llavePrimaria = $request->idmunicipio; //Obtiene el id de un muncipio
        // recupera las colonias del municipio requerido
        $listaColonias = coloniaModelo::where('idmunicol','=',$llavePrimaria)->get(); 
        return response()->json($listaColonias);//Retorna la lista de las colonias en formato json
    }

    /**
     * Funcion para consultar en la base de datos mediante ajax.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return response retorna la información solicitada desde la vista
     */
    public function setProveedor(Request $request){ 
        //Recupera los parametros que se solicitan para agrega un nuevo proveedor y su dirección       
        $nombre= json_decode($request->proveedor[0])->value; //-> Esto ya lo puede convertir en JSON         
        $apP= json_decode($request->proveedor[1])->value;
        $apM = json_decode($request->proveedor[2])->value;        
        $tel = json_decode($request->proveedor[3])->value;
        $correo = json_decode($request->proveedor[4])->value;
        $num = json_decode($request->proveedor[5])->value;
        $numint = json_decode($request->proveedor[6])->value;
        $calle = json_decode($request->proveedor[7])->value;
        $idcolonia = json_decode($request->proveedor[8])->value;
        //Arma la llave primaria para el proveedor
        $llavePrimaria = "PROV-".
        strtoupper($apP[0]).
        strtoupper($apP[1]).
        strtoupper("-".$apM[0]).
        strtoupper($apM[1]).
        strtoupper($num[0]).
        strtoupper($num[1]);
        //Arma la llave primaria para la direccion del proveedor      
        $llavePrimariaDireccion = "DIC-".$tel[0].$tel[1].$apP[0].$apP[1]."-".$apM[0].$apM[1];
        //crea un nuevo modelo para la direccion del proveedor       
        $direccionProveedor = new direccionModelo();
        $direccionProveedor->iddireccion = $llavePrimariaDireccion;
        $direccionProveedor->calle = $calle;
        $direccionProveedor->numero= $num;
        $direccionProveedor->numeroint= $numint;
        $direccionProveedor->idcoldirec = $idcolonia;
        $direccionProveedor->save(); //Almacena la direccion del proveedor a la base de datos        
        //crea un nuevo modelo para almacenar un nuevo proveedor  
        $proveedorTemp = new proveedorModelo();
        $proveedorTemp->idproveedor = $llavePrimaria;
        $proveedorTemp->nombre = $nombre;
        $proveedorTemp->apellidopaterno = $apP;
        $proveedorTemp->apellidomaterno = $apM;
        $proveedorTemp->correo = $correo;
        $proveedorTemp->iddirecproveedor = $llavePrimariaDireccion;
        $proveedorTemp->save(); //Almacena al proveedor a la base de datos
        //crea un nuevo modelo para almacenar un el numero de telefono del proveedor 
        $telefono_prov = new telefonoModelo();
        $telefono_prov->idtelefono = "Tel-".$apP[0].$apM[1]."-".$apM[0].$apM[1]; //Construye la llave primaria
        $telefono_prov->telefono = $tel;
        $telefono_prov->idproveedor = $llavePrimaria;
        $telefono_prov->save(); //Almacena el telefono del proveedor a la tabla
    
        $retornarProveedor = proveedorModelo::find($llavePrimaria); //Busca al proveedor agregado recientemente 
        return response()->json($retornarProveedor);   //retorna al proveedor agregado recientemente en formato json              
    }

    /**
     * Funcion para modificar en la base de datos mediante ajax.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return response retorna la información solicitada desde la vista
     */
    public function cambiosProducto(Request $request){
        //Recupera la información enviada por el usuario mediante ajax
        $clave_producto = json_decode($request->producto[1])->value;
        $nombre_producto = json_decode($request->producto[2])->value;
        $existencia = json_decode($request->producto[3])->value;
        //$stock = json_decode($request->producto[4])->value;
        $clasificacion = json_decode($request->producto[4])->value;
        $precio_venta = json_decode($request->producto[5])->value;
        $precio_compra = json_decode($request->producto[6])->value;
        $descripcion = json_decode($request->producto[7])->value;
        $idProveedor = json_decode($request->producto[8])->value;        
        //actualiza un registro de la tabla productos
        productosModelo::where('clave_producto',$clave_producto)->update([
            'nombre_producto'=>$nombre_producto,
            'clasificacion'=>$clasificacion,
            'precio_producto'=>$precio_venta,
            'precio_compra'=>$precio_compra,
            'cantidad_existencia'=>$existencia,
            //'cantidad_stock'=>$stock,
            'idproveedor'=>$idProveedor
        ]);
        //actualiza un registro de la tabla productosDescripcion
        productosDescripcionModelo::where('clave_producto',$clave_producto)->update([
            'descripcion'=>$descripcion
        ]);  
        return response($idProveedor); //Retorna el id del proveedor
        
    }

    /**
     * Funcion para buscar en la base de datos mediante ajax.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return view retorna la vista con un registro
     */
    public function buscar(Request $request){
        //Recupera el producto solicitado
        $listaProductos = productosModelo::where('$request->nombre_producto','like',$request->inputBusqueda.'%') 
                            ->get();
        return view('productos') ->with ('registrosProductos',$listaProductos); //Retorna a la vista productos con el producto
    }
    
    /**
     * Funcion para buscar en la base de datos mediante ajax.
     * 
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario, de manera oculta.
     * 
     * @return response retonar una cadena con true o false
     */
    public function existe(Request $request){
        $bandera = "NULL";
        //Si encuentra una clave primaria registrada el bdd retorna true
        if (productosModelo::where('clave_producto', "=",$request->clave_producto)->exists()) {
            $bandera = "true";
         }else{
             $bandera = "false";
         }
         return response($bandera);
    }
    public function existeCorreo(Request $request){
        $bandera = "NULL";
        //Si encuentra una clave primaria registrada el bdd retorna true
        if (proveedorModelo::where('correo', "=",$request->correo)->exists()) {
            $bandera = "true";
         }else{
             $bandera = "false";
         }
         return response($bandera);
    }
}
