<?php

namespace App\Http\Controllers;

use App\Models\productosModelo;
use App\Models\proveedorModelo; //proveddores para rellenarlo en la seleccion para agregar

use Illuminate\Http\Request;

class productosController extends Controller
{
    /**
     * Atributos ...
     */
    public  $nombreUsuario;//Este atributo despues lo revisamos
    protected  $productosLista;//Esta variables para guardar la lista de usuarios
    protected $proveedorLista;//Lista de proveedores
    private $camposVista;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        
        $this->productosLista = productosModelo::all();
        $this->proveedorLista = proveedorModelo::all();

            /**
             * Del modelo de caprta App/Http/Models
             *  
            */

        $this->camposVista = ['Clave Producto','Nombre Producto','Clasificación','Precio producto','Existencia','Proveedor','Editar','Borrar'];
    }

    /**
     * Este metodo se usa para indicar que ruta debemos mostrar.
     * el nombre ya lo detecta laravel :v es como el primer metodo que se ejecuta,
     * al mostrar las vistas.
     * 
    */
    public function index()
    {
        # = DB::select('select idusuario from laravelcerrajeria.usuarios');
        # code...
        return view('productos') //Nombre de la vista            
            ->with('camposVista',$this->camposVista)//Campos de la tablas
            ->with('registrosProductos',$this->productosLista)//Registros de la tabla
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

        //Nombre del input del formulario es una tributo "name"
        //Chequen esa parte.

        //Nombre del campo BD----- Nombre input formulario
        $producto->clave_producto = $request->clave_producto;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->clasificacion = $request->clasificacion;
        $producto->precio_producto = $request->precio_producto;
        $producto->cantidad_existencia = $request->cantidad_existencia;
        $arreProveedores = explode(" ",$request->idproveedor);
        $producto->idproveedor = $arreProveedores[0];
        
        
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        //Pero deben de revisar el modelo que les toco, en mi caso es "usuariosModel"
        $producto->save();
        


        //return $request;
        return redirect()->route('productos.index');
    }

    public function show()
    {
        # code...
    }
}
