<?php

namespace App\Http\Controllers;

use App\Models\detalleVentaModelo;
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
        $aniosDisponible = ventaModelo::selectRaw('year(fechayhora) as anio')
            ->groupBy('anio')
            ->orderBy('anio')
            ->get();

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
        $query2 = ventaModelo::join('detalleventa', 'detalleventa.folio_v', 'venta.folio_v')
            ->join('productos', 'productos.clave_producto', 'detalleventa.clave_producto')
            ->where('detalleventa.folio_v', $folio_v->folio_v)->get();

        // $query1 = productosModelo::join('detalleventa as dv', 'dv.clave_producto', '=', 'productos.clave_producto')
        //     ->where('dv.folio_v', '=', $folio_v->folio_v)
        //     ->get();
        return response()->json($query2);
    }


    public function getResumen($mes, $anio)
    {
        if ($mes > 0 && $anio == 0) {

            $ventasPorMes = ventaModelo::selectRaw('SUM(dv.importe) as ganancia, SUM(dv.cantidad) as materialesUtilizados')
                ->join('detalleventa AS dv', 'dv.folio_v', 'venta.folio_v')
                ->whereMonth('fechayhora', $mes)
                ->get();

            $informacion =  ventaModelo::join('detalleventa AS dv', 'dv.folio_v', 'venta.folio_v')
                ->join('productos AS p', 'p.clave_producto', 'dv.clave_producto')
                ->whereMonth('fechayhora', $mes)
                ->get();

            $returno = [
                'resumen' => $ventasPorMes,
                'informacion' => $informacion
            ];

            return response()->json($returno);
        }
        if ($mes == 0 && $anio > 0) {

            $ventasPorAnio = ventaModelo::selectRaw('SUM(dv.importe) as ganancia, SUM(dv.cantidad) as materialesUtilizados')
                ->join('detalleventa AS dv', 'dv.folio_v', 'venta.folio_v')
                ->whereYear('fechayhora', $anio)
                ->get();

            $informacion = ventaModelo::join('detalleventa AS dv', 'dv.folio_v', 'venta.folio_v')
                ->join('productos AS p', 'p.clave_producto', 'dv.clave_producto')
                ->whereYear('fechayhora', $anio)
                ->get();

            $returno = [
                'resumen' => $ventasPorAnio,
                'informacion' => $informacion
            ];

            return response()->json($returno);
        }
        if ($mes > 0 && $anio > 0) {
            $ventasPorMesAnio = ventaModelo::selectRaw('SUM(dv.importe) as ganancia, SUM(dv.cantidad) as materialesUtilizados')
                ->join('detalleventa AS dv', 'dv.folio_v', 'venta.folio_v')
                ->whereYear('fechayhora', $anio)
                ->whereMonth('fechayhora', $mes)
                ->get();
            $informacion = ventaModelo::join('detalleventa AS dv', 'dv.folio_v', 'venta.folio_v')
                ->join('productos AS p', 'p.clave_producto', 'dv.clave_producto')
                ->whereYear('fechayhora', $anio)
                ->whereMonth('fechayhora', $mes)
                ->get();
            $returno = [
                'resumen' => $ventasPorMesAnio,
                'informacion' => $informacion
            ];

            return response()->json($returno);
        }
        return  response()->json([]);
    }

    public function reporteVentas($dia, $mes, $anio)
    {
        $query = [];
        if ($dia == 0) {
            $query = detalleVentaModelo::selectRaw(
                'venta.folio_v,
                        detalleventa.clave_producto,
                        sum(detalleventa.cantidad) AS cantidadVendida,
                        (sum(productos.precio_producto)*detalleventa.cantidad) AS subtotal,
                        (( productos.precio_producto - productos.precio_compra )*sum(detalleventa.cantidad) ) AS ganancia'
            )
                ->join('venta', 'venta.folio_v', 'detalleventa.folio_v')
                ->join('productos', 'productos.clave_producto', 'detalleventa.clave_producto')
                ->whereYear('venta.fechayhora', $anio)
                ->whereMonth('venta.fechayhora', $mes)
                ->groupBy(
                    'venta.folio_v',
                    'detalleventa.clave_producto',
                    'productos.precio_producto',
                    'productos.precio_compra',
                    'detalleventa.cantidad'
                )
                ->get();
        } else {
            $query = detalleVentaModelo::selectRaw(
                'venta.folio_v,
                        detalleventa.clave_producto,
                        sum(detalleventa.cantidad) AS cantidadVendida,
                        (sum(productos.precio_producto)*detalleventa.cantidad) AS subtotal,
                        (( productos.precio_producto - productos.precio_compra )*sum(detalleventa.cantidad) ) AS ganancia'
            )
                ->join('venta', 'venta.folio_v', 'detalleventa.folio_v')
                ->join('productos', 'productos.clave_producto', 'detalleventa.clave_producto')
                ->whereDay('venta.fechayhora', $dia)
                ->whereYear('venta.fechayhora', $anio)
                ->whereMonth('venta.fechayhora', $mes)
                ->groupBy(
                    'venta.folio_v',
                    'detalleventa.clave_producto',
                    'productos.precio_producto',
                    'productos.precio_compra',
                    'detalleventa.cantidad'
                )
                ->get();
        }


        return response()->json($query);
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
