<?php

use App\Http\Controllers\clienteController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\proveedorController;
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
Route::get('/usuarios',[usuarioController::class,'index'])->name('usuarios.index');
Route::get('/proveedores',[proveedorController::class,'index'])->name('proveedores.index');
Route::get('/productos',[productosController::class,'index'])->name('productos.storeindex');
Route::get('/clientes',[clienteController::class,'index'])->name('clientes.index');
Route::get('/ventas',[ventasController::class,'index'])->name('ventas.index');
Route::get('/{pagina}',[RutasController::class,'showView']);

/** 
 * Ruta para guardar  los datos en base de datos, 
 * deben de tener cuidado :v por quisas me equivoque en cada una de sus 
 * rutas asi que pues las componen a conforme esta en "usuarios"
*/
Route::resource('/usuarios',usuarioController::class);
Route::post('/proveedores',[proveedorController::class,'store'])->name('proveedores.store');
Route::post('/productos',[productosController::class,'store'])->name('productos.store');
Route::post('/clientes',[clienteController::class,'store'])->name('clientes.store');
Route::post('/ventas',[ventasController::class,'store'])->name('ventas.store');














/**
 * Lo termine haciendo asi :,,,,,v queria pasarselo aun controlador,
 * y que en el controlador hiciera lo de la rutas, pero no pude :,,,,,,,v 
 * bueno no encontre como hacerlo, asi que mejor puse las rutas manualmente
 * 
*/
//Route::get('/usuarios',[usuarioController::class,'index']);
