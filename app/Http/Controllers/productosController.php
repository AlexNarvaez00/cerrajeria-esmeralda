<?php

namespace App\Http\Controllers;

use App\Models\productosModelo;
use App\Models\proveedorModelo;
use App\Models\estadosModelo;
use App\Models\municipiosModelo;
use App\Models\direccionModelo;
use App\Models\coloniaModelo;
use App\Models\productosDescripcionModelo;

use Illuminate\Http\Request;

class productosController extends Controller
{
    /**
     * Atributos ...
     */
    public  $nombreUsuario;//Este atributo despues lo revisamos
    protected  $productosLista;//Esta variables para guardar la lista de usuarios
    protected $proveedorLista;//Lista de proveedores
    PROTECTED $descripcionLista;//lista de las descripciones de los productos
    private $camposVista;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        
        $this->productosLista = productosModelo::all();
        $this->proveedorLista = proveedorModelo::all();
        $this->descripcionLista = productosDescripcionModelo::all();
        //$this->productosjoin = productosModelo::leftjoin("productodescripcion","productodescripcion.clave_producto", "=", "productos.clave_producto")->select("*")->get();
            /**
             * Del modelo de caprta App/Http/Models
             *  
            */

        $this->camposVista = ['Clave Producto','Nombre Producto','Clasificación','Precio producto','Existencia','idProveedor','Ver detalles','Editar','Borrar'];
    }

    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
    */
    
    public function index(Request $request)
    {
        $listaProductos = null;
        $listaDescripciones = null;
        $estadosLista = estadosModelo::all();
        if(count($request->all()) >= 0){
            $listaProductos = productosModelo::where('clave_producto','like',$request->inputBusqueda.'%') ->get();
            $listaDescripciones = productosDescripcionModelo::where('clave_producto','like',$request->inputBusqueda.'%') ->get();
        }else{
            //Sino tiene nada
            //Que lo rellene con todos los registros 
            $listaProductos = productosModelo::all();
        }
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        //->with('registrosProductosjoin',$this->productosjoin)
        return view('productos') //Nombre de la vista            
            ->with('camposVista',$this->camposVista)//Campos de la tablas
            ->with('registrosProductos',$listaProductos)//Registros de la tabla productos  
            ->with('listaEstados',$estadosLista)          
            ->with('registrosProductosDescripciones',$listaDescripciones) //Registro de las descripciones de los productos
            ->with('registrosProveedores',$this->proveedorLista);//Registros de la tabla proveedores
    }

    /**
     * @param $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario.
     * 
    */
    public function store(Request $request){
        //Creamos un nuevo objeto.
        $producto = new productosModelo();
        $productoDescripcion = new productosDescripcionModelo();

        //Nombre del input del formulario es una tributo "name"
        //Chequen esa parte.

        //Nombre del campo BD----- Nombre input formulario
        $producto->clave_producto = $request->clave_producto;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->clasificacion = $request->clasificacion;
        $producto->precio_producto = $request->precio_producto;
        $producto->cantidad_existencia = $request->cantidad_existencia;
        //parte la cadena y la combierte en un arreglo
        $arreProveedores = explode(" ",$request->idproveedor);
        $producto->idproveedor = $arreProveedores[0];       
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        //Pero deben de revisar el modelo que les toco, en mi caso es "usuariosModel"
        $producto->save();

        $productoDescripcion->clave_producto = $request->clave_producto;
        $productoDescripcion->descripcion = $request->descripcion;
        $productoDescripcion->save();
        //return $request;
        return redirect()->route('productos.index');
    }

    public function getDetalles(Request $request){        
        $descripcionProducto = productosDescripcionModelo::find($request->clave_producto);  
        $proveedor = proveedorModelo::find($request->idproveedor);
        return response()->json(['data' => ['descripcion'=>$descripcionProducto,'proveedor'=>$proveedor]]);
    }
    /**
     * @param $estado - peticion que se realiza por medio de AJAX
     */
    public function getMunicipios(Request $request)
    {
        $llavePrimaria = $request->id;        
        $listaMunicipios = municipiosModelo::where('idestado','=',$llavePrimaria)->get();        
        return response()->json($listaMunicipios);
    }

    public function getColonias(Request $request)
    {
        $llavePrimaria = $request->idmunicipio;
        $listaColonias = coloniaModelo::where('idmunicol','=',$llavePrimaria)->get();
        return response()->json($listaColonias);
    }
    public function setProveedor(Request $request){
        //$proveedorTemp = json_decode($request->proveedor);
        $nombre= json_decode($request->proveedor[0])->value; //-> Esto ya lo puede convertir en JSON 
        $apP= json_decode($request->proveedor[1])->value;
        $apM = json_decode($request->proveedor[2])->value;        
        $tel = json_decode($request->proveedor[3])->value;
        $correo = json_decode($request->proveedor[4])->value;
        $num = json_decode($request->proveedor[5])->value;
        $calle = json_decode($request->proveedor[6])->value;
        $idcolonia = json_decode($request->proveedor[9])->value;
        //Llave primaria del proveedor
        $llavePrimaria = "PROV-".
        strtoupper($apP[0]).
        strtoupper($apP[1]).
        strtoupper("-".$apM[0]).
        strtoupper($apM[1]).
        strtoupper($num[0]).
        strtoupper($num[1]);
        

        //Llave primaria direccion       
        $llavePrimariaDireccion = "DIC-".$tel[0].$tel[1].$apP[0].$apP[1]."-".$apM[0].$apM[1];
        //Agregar tabla direccion        
        $direccionProveedor = new direccionModelo();
        $direccionProveedor->iddireccion = $llavePrimariaDireccion;
        $direccionProveedor->calle = $calle;
        $direccionProveedor->numero= $num;
        $direccionProveedor->idcoldirec = $idcolonia;
        $direccionProveedor->save();
        //Agregar tabla proveedor
        $proveedorTemp = new proveedorModelo();
        $proveedorTemp->idproveedor = $llavePrimaria;
        $proveedorTemp->nombre = $nombre;
        $proveedorTemp->apellidopaterno = $apP;
        $proveedorTemp->apellidomaterno = $apM;
        $proveedorTemp->correo = $correo;
        $proveedor->iddirecproveedor = $llavePrimariaDireccion;
        $proveedorTemp->save();
        //Agregar tabla telefono_proveedor

        //Almacena las tablas
        
        
        
        /*
        $retornarProveedor = proveedorModelo::where('idproveedor','=',$llavePrimaria)->get();
        return response()->json($retornarProveedor); 
        */
        return response($llavePrimariaDireccion);         

    }
}
