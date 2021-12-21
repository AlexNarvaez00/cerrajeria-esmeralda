<?php

use App\Http\Controllers\clienteController;
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

    Route::resource('/reporteVentas',reporteVentasController::class);
    Route::resource('/reporte-venta-productos',reporteVentaProductosController::class);

    /**
     * Rutas solo para AJAX :v 
     */
    //Route::post('/estado/todo',[usuarioController::class,'getCiudades'])->name('estados.todo');

    Route::post('/estado/todo', [proveedorController::class, 'getCiudades'])->name('estados.todo');
    Route::post('/municipio/todo', [proveedorController::class, 'getColonias'])->name('municipios.todo');
    
    
   //Rutas para el modulo de ventas servicios
    Route::post('/estado/servicio',[serviciosController::class,'getCiudades'])->name('estado.servicio');
    Route::post('/municipio/servicio',[serviciosController::class,'getColonias'])->name('municipio.servicio');

    Route::post('/cliente/todo', [serviciosController::class, 'getCliente'])->name('cliente.todo');
    //Rutas para el modulo de ventas de productos
    Route::post('/producto/venta', [ventaProductoController::class, 'getProducto'])->name('producto.venta');
    
    Route::get('/ventas/get/{folio_v}',[reporteVentaProductosController::class,'getProductsAtFolio'])->name('ventas.folio');

    

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
