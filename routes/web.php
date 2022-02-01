<?php

use App\Http\Controllers\clienteController;
use App\Http\Controllers\Notificaciones;
use App\Http\Controllers\ventaProductoController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\reporteVentaProductosController;
use App\Http\Controllers\reporteVentasController;
use App\Http\Controllers\RutasController;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\ventasController;
use App\Http\Controllers\serviciosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('acercade');
});


Route::middleware(['auth'])->group(function () {



    /** 
     * Ruta para cargar los datos en pantalla.
     */

    /** 
     * Ruta para guardar  los datos en base de datos, 
     * deben de tener cuidado :v por quisas me equivoque en cada una de sus 
     * rutas asi que pues las componen a conforme esta en "usuarios"
     */
    Route::resource('/usuarios', usuarioController::class);
    Route::resource('/proveedores', proveedorController::class);
    Route::resource('/productos', productosController::class);
    Route::resource('/clientes', clienteController::class);
    Route::resource('/ventas', ventasController::class);
    Route::resource('/productos-ventas', ventaProductoController::class);
    Route::resource('/servicios-ventas', serviciosController::class);

    Route::resource('/reporte-ventas-servicios',reporteVentasController::class);
    Route::resource('/reporte-venta-productos',reporteVentaProductosController::class);
    Route::resource('/notificaciones',Notificaciones::class);

    /**
     * Rutas solo para AJAX :v 
     */
    //Route::post('/estado/todo',[usuarioController::class,'getCiudades'])->name('estados.todo');

    Route::post('/estado/todo', [proveedorController::class, 'getCiudades'])->name('estados.todo');
    Route::post('/municipio/todo', [proveedorController::class, 'getColonias'])->name('municipios.todo');
    Route::get('/users/get/{email}/{valuePrimary}',[usuarioController::class,'isExists'])->name('user.exists');
    Route::get('/proveedores/get/{email}/{valuePrimary}',[proveedorController::class,'isExists'])->name('proveedor.exists');
    Route::get('/reporte-ventas-servicios/servicios/por/{mes}/{anio}',[reporteVentasController::class,'getResumen'])->name('resumen.servicios');
    Route::get('/reporte-venta-productos/productos/por/{mes}/{anio}',[reporteVentaProductosController::class,'getResumen'])->name('resumen.productos');
    Route::get('/consultalarga/productos/por/{dia}/{mes}/{anio}',[reporteVentaProductosController::class,'reporteVentas'])->name('resumen.productos2');
    
   //Rutas para el modulo de ventas servicios
    Route::post('/estado/servicio',[serviciosController::class,'getCiudades'])->name('estado.servicio');
    Route::post('/municipio/servicio',[serviciosController::class,'getColonias'])->name('municipio.servicio');
    Route::post('/servicio/show', [serviciosController::class,'show'])->name('servicio.show');
    Route::post('/servicio/infoCliente', [serviciosController::class,'getInfoCliente'])->name('infoCliente.servicio');

    Route::post('/cliente/todo', [serviciosController::class, 'getCliente'])->name('cliente.todo');
    //Rutas para el modulo de ventas de productos
    Route::post('/producto/venta', [ventaProductoController::class, 'getProducto'])->name('producto.venta');
    Route::post('/producto/guardarventa', [ventaProductoController::class, 'realizarVenta'])->name('producto.guardarventa');
    Route::post('/producto/guardardetalleventa', [ventaProductoController::class, 'guardarDetalleVenta'])->name('producto.guardardetalleventa');
    
    Route::get('/ventas/get/{folio_v}',[reporteVentaProductosController::class,'getProductsAtFolio'])->name('ventas.folio');
    Route::get('/servicios/get/{servicio}',[reporteVentasController::class,'getServicesAtFolio'])->name('servicios.folio');
    //rutas para productos
    Route::post('/producto/detalles', [productosController::class, 'getDetalles'])->name('producto.detalles');
    Route::post('/municipios/proveedor',[productosController::class,'getMunicipios'])->name('municipios.proveedor');
    Route::post('/colonias/proveedor', [productosController::class, 'getColonias'])->name('colonias.proveedor');
    Route::get('/notificaciones/existencia/total',[Notificaciones::class,'existsNotify'])->name('productos.notificacionesTotal');
    Route::post('/agrega/proveedor', [productosController::class, 'setProveedor'])->name('agrega.proveedor');
    Route::post('/producto/cambiar', [productosController::class, 'cambiosProducto'])->name('producto.cambiar');
    Route::post('/producto/buscar', [productosController::class, 'existe'])->name('producto.buscar');
    Route::post('/producto/buscarcorreo', [productosController::class, 'existeCorreo'])->name('producto.buscarcorreo');
    

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

/**
 * Lo termine haciendo asi :,,,,,v queria pasarselo aun controlador,
 * y que en el controlador hiciera lo de la rutas, pero no pude :,,,,,,,v 
 * bueno no encontre como hacerlo, asi que mejor puse las rutas manualmente
 * 
 */
//Route::get('/usuarios',[usuarioController::class,'index']);

Auth::routes();

/** 
 * Rutas de comodin
 * 
 */
//Route::get('/{pagina}',[RutasController::class,'showView']);
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
