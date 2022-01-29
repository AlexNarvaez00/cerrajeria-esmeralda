<?php

namespace App\Http\Controllers;
use App\Models\productosModelo;
use DB;
use Illuminate\Http\Request;
use App\Models\productosDescripcionModelo;
use App\Models\ventaModelo;
use App\Models\pagoModelo;
use App\Models\detalleVentaModelo;

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
        $this->productos = productosModelo::paginate(10);
        //Son los campos de las tablas
        $this->camposproductosCarrito = ['Clave Producto','Nombre Producto','Productos disponibles','Cantidad','Stock','Precio individual','Quitar'];
        $this->camposProductos = ['Clave Producto','Nombre Producto','Precio compra','Precio venta','Existencia','Stock','Agregar al carrito'];
        $this->camposProductosConfirmar = ['Clave Producto','Nombre Producto','Cantidad','Precio individual','importe'];
    }  
    
    public function index(){
            return view('productos-ventas') //Nombre de la vista            
            ->with('camposProductos',$this->camposProductos)//Campos de la tablas 
            ->with('productos',$this->productos)      
            ->with('registrosProductosDescripcionjoin',$this->productosjoin)
            ->with('camposproductosCarrito',$this->camposproductosCarrito)
            ->with('camposValidar',$this->camposProductosConfirmar);//campos para la tabla en carritos
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
                 
        return response()->json($productoCarrito);
    }

    public function realizarVenta(Request $request){        
        $DateAndTime = date('Y-m-d h:i:s', time());
        $DateAndTime2 = date('Y-m-d H:i:s');        
        $idVenta = str_replace(" ","","COMP-".substr($request->idEmpleado,0,3).$DateAndTime);     

        $ventaTemp = new ventaModelo();
        $ventaTemp->folio_v = $idVenta;
        $ventaTemp->fechayhora = $DateAndTime2;//$DateAndTime2;
        $ventaTemp->idusuario = $request->idEmpleado;
        //$ventaTemp->idclienteventa = 'null';
        $pagoTemp = new pagoModelo();
        $pagoTemp->folio_v = $idVenta;
        $pagoTemp->recibido = $request->recibido;
        $pagoTemp->total_pagar = $request->total;
        $pagoTemp->cambio = $request->cambio;

        $ventaTemp->save();
        $pagoTemp->save();
        return response($idVenta);
    }

    public function guardarDetalleVenta(Request $request){
        
        $idProducto = $request->idProducto;
        $observaciones = $request->observaciones;
        $cantidad = $request->cantidad;
        $folio_v = $request->folio_v;
        $importe = $request->importe;
        
        $detalleTemp = new detalleVentaModelo();
        $detalleTemp->clave_producto = $idProducto;
        $detalleTemp->observaciones = $observaciones;
        $detalleTemp->cantidad = $cantidad;
        $detalleTemp->folio_v = $folio_v;
        $detalleTemp->importe = $importe; 
        $detalleTemp->save();
        
        $productoModificar= productosModelo::find($idProducto);
        $cantidadExistencia = $productoModificar->cantidad_existencia;
        $productoModificar->cantidad_existencia = $cantidadExistencia - $cantidad;
        $productoModificar->save();  
        
        return response($folio_v);
    }

    
    
   
}
