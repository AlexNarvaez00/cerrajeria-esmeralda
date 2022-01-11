<?php

namespace App\Http\Controllers;

use App\Models\productosModelo;
use App\Models\ventaModelo;
use Illuminate\Http\Request;

/**
 * @author Narvaez Ruiz Alexis
 * @author Martinez Jimenez Jennifer
 * 
 */
class reporteVentaProductosController extends Controller
{
    /**
    | ------------------------------------------------------
    |   reporteVentaProductosController -> Reporte de las ventas de los prodcutos
    | ------------------------------------------------------
    |   
    |   Constrolador untilizado para hacer las consultas a las  
    |   tablas principales para generar los reportes
    |   "Productos","detalleventa","venta", estas consultas son
    |   visualizadas en la tabla principal de la vista.
    | 
     */

    /**
     * Array que contiene los campos que se visualizaran 
     * en la tabla principal.
     * 
     * @var array
     */
    private $camposVista;

    /**
     *Contructor 
     */
    public function __construct()
    {
        $this->camposVista = ['Folio venta', 'ID Usuario', 'Fecha', 'Consultar'];
    }

    /**
     * Funcion index, es la primera funcion en ejecutarse al memento de renderizar 
     * la vista.
     * 
     * @param Request $request Solicitud por parte del navegador.
     * 
     * @return View Vista de "reporte-venta-productos"
     * 
     */
    public function index(Request $request)
    {
        $listaReporte = null;
        if (count($request->all()) >= 0) {
            $listaReporte = $this->getVentasPorConsulta($request);
        } else {
            //se rellena con todos los registros
            $listaReporte = ventaModelo::paginate(10);
        }
        $aniosDisponible = ventaModelo::selectRaw('year(fechayhora) as anio')->groupBy('anio')->get();

        return view('reporteVentaProductos')
            ->with('camposVista', $this->camposVista)
            ->with('aniosDisponibles', $aniosDisponible)
            ->with('registrosVista', $listaReporte);
    }
    /**
     * Obtiene los registros, dependiendo de la consulta.
     * 
     * @param Request $request Solicitud por parte del navegador.
     * 
     * @return array $rows Registros filtrados. 
     * 
     */
    private function getVentasPorConsulta(Request $request)
    {
        $rows = null;

        if ($request->has('inputBusqueda') && $request->inputBusqueda != null) {
            $rows = ventaModelo::where('folio_v', 'like', $request->inputBusqueda . '%');
        }
        if ($request->has('inputSelectorMes') && $request->inputSelectorMes != null && $request->inputSelectorMes != "0") {
            if ($rows == null) {
                $rows = ventaModelo::where('folio_v', 'like', '%');
            }
            $rows = $rows->whereMonth('fechayhora', '=', $request->inputSelectorMes);
        }
        if ($request->has('inputSelectorAnio') && $request->inputSelectorAnio != null && $request->inputSelectorAnio != "0") {
            if ($rows == null) {
                $rows = ventaModelo::where('folio_v', 'like', '%');
            }
            $rows = $rows->whereYear('fechayhora', '=', $request->inputSelectorAnio);
        }

        if ($rows == null) {
            $rows = ventaModelo::paginate(10);
        } else {
            $rows = $rows->paginate(10);
        }
        return $rows;
    }

    /**
     * Regresa el JOIN entre las tablas detalleventa, venta y productos
     * 
     * @param ventaModelo $folio_v Registro de la venta en la base de datos. 
     * @return array JSON JSON con la informacion de la consulta.
     */
    public function getProductsAtFolio(ventaModelo $folio_v)
    {
        $query1 = productosModelo::join('detalleventa as dv', 'dv.clave_producto', '=', 'productos.clave_producto')
            ->where('dv.folio_v', '=', $folio_v->folio_v)
            ->get();
        return response()->json($query1);
    }


    /* ---------------------------------------------------------------------------------------------------------------------*/

    public function store(Request $request)
    {
        //return redirect()->route('reporteVentas.index');       
    }

    public function show(Request $request, $reporte)
    {
    }
    /**
     * Método para borrar registros de la base de datos
     */
    public function destroy(ventaModelo $reporte)
    {
        //$reporte->delete();
        //return redirect()->route('reporteProductos.index');
    }
}
