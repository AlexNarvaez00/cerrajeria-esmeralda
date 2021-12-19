<?php

use App\Http\Controllers\clienteController;
use App\Http\Controllers\ventaProductoController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\proveedorController;
use App\Http\Controllers\reporteProductosController;
use App\Http\Controllers\reporteVentasController;
use App\Http\Controllers\RutasController;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\ventasController;
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
    return view('login');
});

/** 
 * Ruta para cargar los datos en pantalla.
*/
// Route::get('/usuarios',[usuarioController::class,'index'])->name('usuarios.index');
// Route::get('/proveedores',[proveedorController::class,'index'])->name('proveedores.index');
// Route::get('/productos',[productosController::class,'index'])->name('productos.storeindex');
// Route::get('/clientes',[clienteController::class,'index'])->name('clientes.index');
// Route::get('/ventas',[ventasController::class,'index'])->name('ventas.index');
// Route::get('/productos-ventas',[ventaProductoController::class,'index'])->name('productos-ventas.index');


/** 
 * Ruta para guardar  los datos en base de datos, 
 * deben de tener cuidado :v por quisas me equivoque en cada una de sus 
 * rutas asi que pues las componen a conforme esta en "usuarios"
*/
Route::resource('/usuarios',usuarioController::class);
Route::resource('/proveedores',proveedorController::class);
Route::resource('/productos',productosController::class);
Route::resource('/clientes',clienteController::class);
Route::resource('/ventas',ventasController::class);
Route::resource('/productos-ventas',ventaProductoController::class);
Route::resource('/reporteVentas',reporteVentasController::class);
Route::resource('/reporteProductos',reporteProductosController::class);
Route::get('/{pagina}',[RutasController::class,'showView']);












/**
 * Lo termine haciendo asi :,,,,,v queria pasarselo aun controlador,
 * y que en el controlador hiciera lo de la rutas, pero no pude :,,,,,,,v 
 * bueno no encontre como hacerlo, asi que mejor puse las rutas manualmente
 * 
*/
//Route::get('/usuarios',[usuarioController::class,'index']);
