<?php

namespace App\Http\Controllers;
use App\Models\productosModelo;
use Illuminate\Http\Request;
use App\Models\productosDescripcionModelo;

class ventaProductoController extends Controller
{
    /**
     * Atributos ...
     */
    public  $nombreUsuario;//Este atributo despues lo revisamos    
    protected $productosCarrito;//Este atributo debera contener los productos que esten en el carrito   
   
    


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        //realiza un join para unir dos tablas
        $this->productosjoin = productosModelo::join("productodescripcion","productodescripcion.clave_producto", "=", "productos.clave_producto")
        ->select("*")
        ->get();
        //Son los campos de las tablas
        $this->camposproductosCarrito = ['Clave Producto','Nombre Producto','Cantidad','Observaciones','Total por producto'];
        $this->camposProductos = ['Clave Producto','Nombre Producto','Precio','Existencia','Agregar al carrito'];
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
        return view('productos-ventas') //Nombre de la vista            
            ->with('camposProductos',$this->camposProductos)//Campos de la tablas           
            ->with('registrosProductosDescripcionjoin',$this->productosjoin)
            ->with('camposproductosCarrito',$this->camposproductosCarrito);//campos para la tabla en carritos
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
             
        

        
        
        //Con este metodo lo guradamos, ya no necesitamos consultas SQL 
        //Pero deben de revisar el modelo que les toco, en mi caso es "usuariosModel"
        $producto->save();


        //return $request;
        return redirect()->route('productos-ventas.index');
    }
    public function show($id){
        
    }
    
    /**
     * @param $estado - peticion que se realiza por medio de AJAX
     */
    public function getProducto(Request $request)
    {
        //Recuperamos la llave primaria de productos
       
        //Lista de municipios que coicidan con la llaveprimaria 
        $productocarrito = productosModelo::where('clave_producto','=',$llavePrimaria)->get();
        
        //El 200 significa que las peticiones son buenas.
        //json_encode ---- es para que en JS se manipule mas rapido.
        return response()->json($productocarrito);
    }
}
