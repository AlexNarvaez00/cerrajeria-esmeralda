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
    protected  $productosLista;//Esta variables para guardar la lista de usuarios
    protected $productosCarrito;
    protected $productosDescripcionLista;
    protected $productosjoin;
    private $camposVista;


    //Pagina para referenciar las cosas xd    
    //https://richos.gitbooks.io/laravel-5/content/capitulos/chapter10.html

    public function __construct()
    {
        $this->productosjoin = productosModelo::join("productodescripcion","productodescripcion.clave_producto", "=", "productos.clave_producto")
        ->select("*")
        ->get();
        
        $this->productosLista = productosModelo::all();
        $this->productosDescripcionLista = productosDescripcionModelo::all();
            /**
             * Del modelo de caprta App/Http/Models
             *  
            */
        $this->camposproductosCarrito = ['Calve Producto','Nombre Producto','Cantidad','Observaciones','Total por producto'];
        $this->camposProductos = ['Clave Producto','Nombre Producto','Precio','Existencia','Descripcion','Agregar al carrito'];
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
            ->with('registrosProductos',$this->productosLista)//Registros de la tabla
            ->with('registrosProductosDescripcion',$this->productosDescripcionLista)
            ->with('registrosProductosDescripcionjoin',$this->productosjoin)
            ->with('camposproductosCarrito',$this->camposproductosCarrito);//campos para la tabla en carritos
    }
    public function getDescripcion($claved){
        echo $claved;
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

    public function show()
    {
        # code...
    }
}
