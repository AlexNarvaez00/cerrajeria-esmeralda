<?php

namespace App\Http\Controllers;

use App\Models\servicioModelo;
use App\Models\productosModelo;
use App\Models\ventaModelo;
use Illuminate\Http\Request;

/**
 * @author Narvaez Ruiz Alexis
 * @author Martinez Jimenez Jennifer
 * 
 */
class reporteVentasController extends Controller
{
    /*
    |  ------------------------------------------------
    |   reporteVentasController -> venta de servicios
    |  ------------------------------------------------
    |   Controlador apatra visualizar las consultas a las tablas 
    |   "Productos","Servicios","DetalleServicio", estas consultas son
    |   visualizadas la tabla principal de la vista.  
    |   
    */


    /**
     * Lista de registros a partir de las consultas, de las 
     * tablas principales sobre este controlador. 
     * 
     * @var array 
     */
    protected  $reporteLista;

    public function __construct()
    {
        $this->camposTabla = ["#", "Fecha/Hora", "ID Direccion", "Monto", "Descripcion", "ID Cliente", "Ver"];
    }

    /**
     * Funcion que ejecutada cuando la ruta de "reporte-ventas-servicios" es 
     * solicitada por el navegador.
     * 
     * @param Request $request Solicitud por parte del navgador.
     * 
     * @return View Vista de "reporteVentasServicios".
     */
    public function index(Request $request)
    {
        $listaReporte = null;
        if (count($request->all()) >= 1) {
            $listaReporte = $this->getServiciosPorConsulta($request);
        } else {
            //se rellena con todos los registros
            $listaReporte = servicioModelo::paginate(10);
        }
        $aniosDisponible = servicioModelo::selectRaw('year(fechayhora) as anio')->groupBy('anio')->get();
        return view('reporteVentasServicios') //Nombre de la vista
            ->with('camposTabla', $this->camposTabla) //Campos de la tablas
            ->with('aniosDisponibles', $aniosDisponible)
            ->with('registrosVista', $listaReporte); //Registros de la tabla
    }

    /**
     * Obtiene los registros, dependiendo de la consulta.
     * 
     * @param Request $request Solicitud por parte del navegador.
     * 
     * @return $rows Registros filtrados. 
     */
    private function getServiciosPorConsulta(Request $request)
    {
        $rows = null;

        if ($request->has('inputBusqueda') && $request->inputBusqueda != null) {
            $rows = servicioModelo::where('idservicio', 'like', $request->inputBusqueda . '%');
        }
        if ($request->has('inputSelectorMes') && $request->inputSelectorMes != null && $request->inputSelectorMes != "0") {
            if ($rows == null) {
                $rows = servicioModelo::where('idservicio', 'like', '%');
            }
            $rows = $rows->whereMonth('fechayhora', '=', $request->inputSelectorMes);
        }
        if ($request->has('inputSelectorAnio') && $request->inputSelectorAnio != null && $request->inputSelectorAnio != "0") {
            if ($rows == null) {
                $rows = servicioModelo::where('idservicio', 'like', '%');
            }
            $rows = $rows->whereYear('fechayhora', '=', $request->inputSelectorAnio);
        }

        if ($rows == null) {
            $rows = servicioModelo::paginate(10);
        } else {
            $rows = $rows->paginate(10);
        }
        return $rows;
    }

    /**
     * Regresa el JOIN entre las tablas detalleventa, venta y servicios.
     * 
     * @param servicioModelo $servicio Registro del servicio en la base de datos.
     * @return array Resultado de la consulta en formato JSON.
     */
    public function getServicesAtFolio(servicioModelo $servicio)
    {
        $query1 = productosModelo::join('detalleservicio as ds', 'ds.clave_producto', '=', 'productos.clave_producto')
            ->where('ds.idservicio', '=', $servicio->idservicio)
            ->get();
        return response()->json($query1);
    }

    public function getResumen($mes,$anio)
    {
        if ($mes > 0 && $anio == 0) {
            $ventasPorMes = servicioModelo::selectRaw('SUM(servicio.monto) as ganancia, SUM(ds.cantidad) as materialesUtilizados')
                ->join('detalleservicio AS ds', 'ds.idservicio', 'servicio.idservicio')
                ->whereMonth('fechayhora', $mes)
                ->get();
            return response()->json($ventasPorMes);
        }
        if ($mes == 0 && $anio > 0) {
            $ventasPorAnio = servicioModelo::selectRaw('SUM(servicio.monto) AS ganancia, SUM(ds.cantidad) AS materialesUtilizados')
                ->join('detalleservicio AS ds', 'ds.idservicio', 'servicio.idservicio')
                ->whereYear('fechayhora', $anio)
                ->get();
            return response()->json($ventasPorAnio);
        }
        if ($mes > 0 && $anio > 0) {
            $ventasPorMesAnio = servicioModelo::selectRaw('SUM(servicio.monto) as ganancia, SUM(ds.cantidad) as materialesUtilizados')
                ->join('detalleservicio AS ds', 'ds.idservicio', 'servicio.idservicio')
                ->whereYear('fechayhora', $anio)
                ->whereMonth('fechayhora', $mes)
                ->get();
            return response()->json($ventasPorMesAnio);
        }
        return  response()->json([]);
    }
    /**
     * @param Request $request Este objeto se ecarga de recibir la informacion
     * que enviamos por el formulario.
     * 
     */
    public function store(Request $request)
    {
    }


    /**
     * @param Request $request Solicitud por parte del navegador.
     * @param mixed $servicio Registro de la tabla de "servicio".
     * 
     */
    public function show(Request $request, $servicio)
    {
    }
}
