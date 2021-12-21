<?php

namespace App\Http\Controllers;
use App\Models\productosModelo;
use DB;
use Illuminate\Http\Request;
use App\Models\productosDescripcionModelo;

class ventaProductoController extends Controller
{
    /**
     * Atributos ...
     */
    public  $nombreUsuario;//Este atributo despues lo revisamos    
    protected $productosCarrito;//Este atributo debera contener los productos que esten en el carrito   
   
    




    public function __construct()
    {
        //realiza un join para unir dos tablas
        $this->productosjoin = productosModelo::leftJoin("productodescripcion","productodescripcion.clave_producto", "=", "productos.clave_producto")
        ->select("*")
        ->get();
        //Son los campos de las tablas
        $this->camposproductosCarrito = ['Clave Producto','Nombre Producto','Cantidad','Observaciones','Total por producto'];
        $this->camposProductos = ['Clave Producto','Nombre Producto','Precio','Existencia','Agregar al carrito'];
    }  
    
    public function index(){
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
        $producto->save();
        //return $request;
        return redirect()->route('productos-ventas.index');
    }

    public function getProducto(Request $request){
        $productoCarrito = productosModelo::find($request->clave_producto);
        DB::table('productos')
        ->where('clave_producto', $request->clave_producto)
        ->update(['cantidad_existencia' => $request->cantidadExistente]);          
        return response()->json($productoCarrito);
    }
    
    
   
}
