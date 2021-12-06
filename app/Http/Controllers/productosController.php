<?php

namespace App\Http\Controllers;

use App\Models\productosModelo;
use App\Models\proveedorModelo; //proveddores para rellenarlo en la seleccion para agregar
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
        

            /**
             * Del modelo de caprta App/Http/Models
             *  
            */

        $this->camposVista = ['Clave Producto','Nombre Producto','Clasificación','Precio producto','Existencia','idProveedor','Editar','Borrar'];
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
        return view('productos') //Nombre de la vista            
            ->with('camposVista',$this->camposVista)//Campos de la tablas
            ->with('registrosProductos',$listaProductos)//Registros de la tabla productos
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

    public function show()
    {
        # code...
    }
}
